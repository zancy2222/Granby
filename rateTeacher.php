    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <?php
    require 'dbcon.php';


    include('includes/header.php');
    include('includes/navbar.php');
    include('message.php');

    // Get the teacher ID from the URL
    $teacher_id = isset($_GET['teacher_id']) ? mysqli_real_escape_string($con, $_GET['teacher_id']) : '';

    $rating_query = "SELECT AVG((Q1 + Q2 + Q3 + Q4 + Q5 + Q6 + Q7 + Q8 + Q9) / 9 * 20) as overall_rating
                    FROM evaluation_form
                    WHERE teacher_id = '$teacher_id'";

    $rating_result = mysqli_query($con, $rating_query);

    if (!$rating_result) {
        echo "Rating query failed: " . mysqli_error($con);
        die();
    }

    $rating = mysqli_fetch_assoc($rating_result);
    $overall_rating = $rating['overall_rating'] ? round($rating['overall_rating'], 2) : 'N/A';

    // Get teacher information
    $teacher_query = "SELECT * FROM teacher WHERE id = '$teacher_id'";
    $teacher_result = mysqli_query($con, $teacher_query);

    if (!$teacher_result) {
        echo "Teacher query failed: " . mysqli_error($con);
        die();
    }

    $teacher = mysqli_fetch_assoc($teacher_result);

    if (!$teacher) {
        echo "Teacher not found for ID: " . $teacher_id;
        die();
    }

    // Get list of students who evaluated this teacher
    $eval_query = "SELECT DISTINCT user_id
                FROM evaluation_form
                WHERE teacher_id = '$teacher_id'";

    $eval_result = mysqli_query($con, $eval_query);

    if (!$eval_result) {
        echo "Evaluation query failed: " . mysqli_error($con);
        die();
    }

    ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
                <!-- Topbar Search -->
                <!-- Topbar Search -->
                <form id="searchForm" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control bg-light border-0 small" placeholder="Search for student Id?" aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="searchButton">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>




                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                        problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how
                                        would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with
                                        the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                        told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                            <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">
                    <i class="fas fa-chalkboard-teacher mr-2 icon-blue"></i>
                    Students who evaluated <?= htmlspecialchars($teacher['Tname']); ?>
                </h1>
                <p class="mb-3">
                    <i class="fas fa-book mr-2 icon-green"></i>
                    Subject: <?= htmlspecialchars($teacher['Tsubject']); ?>
                </p>
                <p class="mb-5">
                    <i class="fas fa-star mr-2 icon-yellow"></i>
                    Overall Rating: <?= $overall_rating ?> / 100
                </p>

                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-list mr-2 icon-blue"></i>
                            Evaluation List
                        </h6>
                        <button class="btn btn-primary btn-sm" id="toggleView">
                            <i class="fas fa-th-large mr-2"></i>
                            Toggle View
                        </button>
                    </div>
                    <div class="card-body">
    <?php if (mysqli_num_rows($eval_result) == 0) : ?>
        <p class="text-center text-muted">
            <i class="fas fa-info-circle mr-2"></i>
            No evaluations found for this teacher.
        </p>
    <?php else : ?>
        <div class="table-responsive" id="tableView">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>Student ID</th>
                        <th>Subject</th>
                        <th>Rate</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysqli_data_seek($eval_result, 0);
                    $id = 1; // Initialize the counter
                    while ($eval = mysqli_fetch_assoc($eval_result)) :
                        $student_rating_query = "SELECT AVG((Q1 + Q2 + Q3 + Q4 + Q5 + Q6 + Q7 + Q8 + Q9) / 9 * 20) as student_rating
                                                FROM evaluation_form
                                                WHERE teacher_id = '$teacher_id' AND user_id = '{$eval['user_id']}'";
                        $student_rating_result = mysqli_query($con, $student_rating_query);
                        $student_rating_row = mysqli_fetch_assoc($student_rating_result);
                        $student_rating = $student_rating_row['student_rating'] ? round($student_rating_row['student_rating'], 2) : 'N/A';
                    ?>
                        <tr>
                            <td>
                                <i class="fas fa-user-graduate mr-2 icon-yellow"></i>
                                ***** <!-- Displaying obfuscated student ID -->
                            </td>
                            <td><?= htmlspecialchars($teacher['Tsubject']); ?></td>
                            <td><?= $student_rating ?> / 100</td>
                            <td>
                                <a href="viewevaluation.php?teacher_id=<?= $teacher_id ?>&student_id=<?= $eval['user_id'] ?>" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye mr-2"></i>
                                    View Evaluation
                                </a>
                            </td>
                        </tr>
                    <?php
                        $id++; // Increment the ID after each iteration
                    endwhile;
                    ?>

                </tbody>
            </table>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 d-none" id="cardView">
            <?php
            mysqli_data_seek($eval_result, 0);
            while ($eval = mysqli_fetch_assoc($eval_result)) :
                $student_rating_query = "SELECT AVG((Q1 + Q2 + Q3 + Q4 + Q5 + Q6 + Q7 + Q8 + Q9) / 9 * 20) as student_rating
                                        FROM evaluation_form
                                        WHERE teacher_id = '$teacher_id' AND user_id = '{$eval['user_id']}'";
                $student_rating_result = mysqli_query($con, $student_rating_query);
                $student_rating_row = mysqli_fetch_assoc($student_rating_result);
                $student_rating = $student_rating_row['student_rating'] ? round($student_rating_row['student_rating'], 2) : 'N/A';
            ?>
                <div class="col mb-4">
                    <div class="card h-100 border-left-primary shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-user-graduate mr-2 icon-yellow"></i>
                                Student ID: ***** <!-- Displaying obfuscated student ID -->
                            </h5>
                            <p>Rate: <?= $student_rating ?> / 100</p>
                            <a href="viewevaluation.php?teacher_id=<?= $teacher_id ?>&student_id=<?= $eval['user_id'] ?>" class="btn btn-primary btn-sm mt-2">
                                <i class="fas fa-eye mr-2"></i>
                                View Evaluation
                            </a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const toggleViewBtn = document.getElementById('toggleView');
                    const tableView = document.getElementById('tableView');
                    const cardView = document.getElementById('cardView');

                    toggleViewBtn.addEventListener('click', function() {
                        tableView.classList.toggle('d-none');
                        cardView.classList.toggle('d-none');

                        const icon = toggleViewBtn.querySelector('i');
                        if (icon.classList.contains('fa-th-large')) {
                            icon.classList.replace('fa-th-large', 'fa-list');
                            icon.classList.add('icon-red');
                            icon.classList.remove('icon-blue');
                        } else {
                            icon.classList.replace('fa-list', 'fa-th-large');
                            icon.classList.add('icon-blue');
                            icon.classList.remove('icon-red');
                        }
                    });
                });
            </script>

            <style>
                .icon-blue {
                    color: #4e73df;
                }

                .icon-green {
                    color: #1cc88a;
                }

                .icon-yellow {
                    color: #f6c23e;
                }

                .icon-red {
                    color: #e74a3b;
                }
            </style>