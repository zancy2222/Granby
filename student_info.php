<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
<?php
session_start();

?>
<?php
include('dbcon.php');
include('delete_student.php');
include('includes/header.php');
include('includes/navbar.php');
include('message.php');



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

        <div class="container-xl color">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h2>Manage <b>Students</b></h2>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-danger" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-caret-down"></i><span>Student Category</span></button>

                                <!-- Dropdown Menu -->
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                </div>
                                <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Student</span></a>

                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full name</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Section</th>
                                <th>age</th>
                                <th>actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $entriesPerPage = 7;
                            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

                            $query = "SELECT * FROM Slogin";
                            $query_run = mysqli_query($con, $query);


                            // Check if the query was executed successfully
                            if ($query_run) {
                                // Calculate total pages for pagination
                                $totalEntries = mysqli_num_rows($query_run);
                                $totalPages = ceil($totalEntries / $entriesPerPage);

                                // Calculate offset for pagination
                                $offset = ($currentPage - 1) * $entriesPerPage;

                                // Re-run the query with pagination limits
                                $query = "SELECT * FROM Slogin LIMIT $offset, $entriesPerPage";
                                $query_run = mysqli_query($con, $query);

                                // Check if the re-run query was executed successfully
                                if ($query_run) {
                                    // Loop through the query results to display student information
                                    foreach ($query_run as $student) {
                            ?>
                                        <tr>
                                            <td><?= $student['id']; ?></td>
                                            <td><?= $student['fullname']; ?></td>
                                            <td><?= $student['emails']; ?></td>
                                            <td><?= $student['Phonenum']; ?></td>
                                            <td><?= $student['Section']; ?></td>
                                            <td><?= $student['age']; ?></td>
                                            <td>
                                                <a href="#editstudent<?= $student['id']; ?>" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>

                                                <a href="delete_student.php?id=<?php echo $student['id'] ?>" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                                            </td>

                                        </tr>
                            <?php
                                    }
                                } else {
                                    // If the re-run query fails, display an error message
                                    echo "<h5>Record not found!!</h5>";
                                }
                            } else {
                                // If the initial query fails, display an error message
                                echo "<h5>Error executing the query</h5>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <!-- Edit Modals -->
                    <?php
                    // Re-run the query to fetch student data for edit modals
                    $query_run = mysqli_query($con, $query);

                    // Check if the query was executed successfully
                    if ($query_run) {
                        // Loop through the query results to display edit modals
                        foreach ($query_run as $student) {
                    ?>
                            <div id="editstudent<?= $student['id']; ?>" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="" method="post">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Student</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="student_id" value="<?= $student['id']; ?>" class="form-control" required readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input type="text" name="fullname" value="<?= $student['fullname']; ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="emails" value="<?= $student['emails']; ?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Phone Number</label>
                                                    <input type="text" class="form-control" name="Phonenum" value="<?= $student['Phonenum']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Section</label>
                                                    <input type="text" class="form-control" name="Section" value="<?= $student['Section']; ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Age</label>
                                                    <input type="text" class="form-control" name="age" value="<?= $student['age']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                                <button type="submit" class="btn btn-primary" name="edit_changes">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>


                </div>

                <div class="clearfix">
                    <div class="hint-text">Showing <b><?= $entriesPerPage; ?></b> out of <b><?= $totalEntries; ?></b> entries</div>
                    <ul class="pagination">
                        <!-- Previous page button -->
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : ''; ?>">
                            <a href="?page=<?= $currentPage - 1; ?>" class="page-link">Previous</a>
                        </li>

                        <!-- Page links -->
                        <?php for ($page = 1; $page <= $totalPages; $page++) : ?>
                            <li class="page-item <?= $page == $currentPage ? 'active' : ''; ?>">
                                <a href="?page=<?= $page; ?>" class="page-link"><?= $page; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next page button -->
                        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                            <a href="?page=<?= $currentPage + 1; ?>" class="page-link">Next</a>
                        </li>
                    </ul>
                </div>




                <div id="successModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Success</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Changes saved successfully!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="errorModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Error</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Error occurred while saving changes!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div id="addEmployeeModal" class="modal fade">

                    <?php include('message.php'); ?>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header">

                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Section</label>
                                        <input type="text" class="form-control" name="section" required></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="gradelevel">Grade Level</label>
                                        <select class="form-control" name="gradelevel" required>
                                            <option>First year college</option>
                                            <option>2nd year college</option>
                                            <option>Third year college</option>
                                            <option>fourth year college</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <input type="submit" class="btn btn-success" value="Add" name="save_student" data-bs-toggle="modal" data-bs-target="#exampleModal">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal HTML -->

                <div id="deleteStudent" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="" method="post">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete Student</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this record?</p>
                                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                                    <!-- Hidden input to store student_id -->
                                    <input type="hidden" id="delete_student_id" name="delete_students" value="">
                                </div>
                                <div class="modal-footer">
                                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                    <button type="submit" class="btn btn-danger" value="Delete" name="delete">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- End of Main Content -->

            <script>
                $(document).on('click', ".edit", function() {
                    var student_id = $(this).data('student-id');
                    var name = $(this).data('student-name');
                    var email = $(this).data('student-email');
                    var section = $(this).data('student-section');
                    var gradelevel = $(this).data('student-gradelevel');

                    // Set values in the modal
                    $('#edit_student_id').val(student_id);
                    $('#edit_name').val(name);
                    $('#edit_email').val(email);
                    $('#edit_section').val(section);
                    $('#edit_gradelevel').val(gradelevel);

                    $('#editstudent').modal('show');
                });
            </script>


            <script>
                $(document).ready(function() {
                    // Add an event listener to the search button
                    $("#searchButton").click(function() {
                        // Get the search query
                        var searchQuery = $("#searchInput").val();

                        // Perform an AJAX request to fetch and update content based on the search query
                        $.ajax({
                            type: "GET",
                            url: "search.php",
                            data: {
                                student_id: searchQuery
                            }, // Pass the search query to the server
                            success: function(data) {
                                // Update the content area with the fetched data
                                $("#content").html(data);
                            },
                            error: function() {
                                console.error("Error in AJAX request");
                            }
                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    $('.delete').click(function() {
                        var student_id = $(this).data('studentid');
                        $('#delete_student_id').val(student_id);
                    });
                });
            </script>


            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>


            <style>
                body {
                    color: #566787;
                    background: #f5f5f5;
                    font-family: 'Varela Round', sans-serif;
                    font-size: 13px;
                }

                .table-responsive {
                    margin: 30px 0;

                }

                .table-wrapper {
                    background: #fff;
                    padding: 20px 25px;
                    border-radius: 3px;
                    min-width: 1000px;
                    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);

                }

                .table-title {
                    padding-bottom: 15px;
                    background: #4e73df;
                    color: #fff;
                    padding: 16px 30px;
                    min-width: 100%;
                    margin: -20px -25px 10px;
                    border-radius: 3px 3px 0 0;
                }

                .table-title h2 {
                    margin: 5px 0 0;
                    font-size: 24px;
                }

                .table-title .btn-group {
                    float: right;
                }

                .table-title .btn {
                    color: #fff;
                    float: right;
                    font-size: 13px;
                    border: none;
                    min-width: 50px;
                    border-radius: 2px;
                    border: none;
                    outline: none !important;
                    margin-left: 10px;
                }

                .table-title .btn i {
                    float: left;
                    font-size: 21px;
                    margin-right: 5px;
                }

                .table-title .btn span {
                    float: left;
                    margin-top: 2px;
                }

                table.table tr th,
                table.table tr td {

                    border-color: #e9e9e9;
                    padding: 5px 15px;
                    vertical-align: middle;


                }


                table.table tr th:first-child {
                    width: 60px;

                }

                table.table tr th:last-child {
                    width: 100px;
                }

                table.table-striped tbody tr:nth-of-type(odd) {
                    background-color: #fcfcfc;
                }

                table.table-striped.table-hover tbody tr:hover {
                    background: #f5f5f5;
                }

                table.table th i {
                    font-size: 13px;
                    margin: 0 5px;
                    cursor: pointer;
                }

                table.table td:last-child i {
                    opacity: 0.9;
                    font-size: 22px;
                    margin: 0 5px;
                }

                table.table td a {
                    font-weight: bold;
                    color: #566787;
                    display: inline-block;
                    text-decoration: none;
                    outline: none !important;
                }

                table.table td a:hover {
                    color: #2196F3;
                }

                table.table td a.edit {
                    color: #FFC107;
                }

                table.table td a.delete {
                    color: #F44336;
                }

                table.table td i {
                    font-size: 19px;
                }

                table.table .avatar {
                    border-radius: 50%;
                    vertical-align: middle;
                    margin-right: 10px;
                }

                .pagination {
                    float: right;
                    margin: 0 0 5px;
                }

                .pagination li a {
                    border: none;
                    font-size: 13px;
                    min-width: 30px;
                    min-height: 30px;
                    color: #999;
                    margin: 0 2px;
                    line-height: 30px;
                    border-radius: 2px !important;
                    text-align: center;
                    padding: 0 6px;
                }

                .pagination li a:hover {
                    color: #666;
                }

                .pagination li.active a,
                .pagination li.active a.page-link {
                    background: #03A9F4;
                }

                .pagination li.active a:hover {
                    background: #0397d6;
                }

                .pagination li.disabled i {
                    color: #ccc;
                }

                .pagination li i {
                    font-size: 16px;
                    padding-top: 6px
                }

                .hint-text {
                    float: left;
                    margin-top: 10px;
                    font-size: 13px;
                }

                /* Custom checkbox */
                .custom-checkbox {
                    position: relative;
                }

                .custom-checkbox input[type="checkbox"] {
                    opacity: 0;
                    position: absolute;
                    margin: 5px 0 0 3px;
                    z-index: 9;
                }

                .custom-checkbox label:before {
                    width: 18px;
                    height: 18px;
                }

                .custom-checkbox label:before {
                    content: '';
                    margin-right: 10px;
                    display: inline-block;
                    vertical-align: text-top;
                    background: white;
                    border: 1px solid #bbb;
                    border-radius: 2px;
                    box-sizing: border-box;
                    z-index: 2;
                }

                .custom-checkbox input[type="checkbox"]:checked+label:after {
                    content: '';
                    position: absolute;
                    left: 6px;
                    top: 3px;
                    width: 6px;
                    height: 11px;
                    border: solid #000;
                    border-width: 0 3px 3px 0;
                    transform: inherit;
                    z-index: 3;
                    transform: rotateZ(45deg);
                }

                .custom-checkbox input[type="checkbox"]:checked+label:before {
                    border-color: #03A9F4;
                    background: #03A9F4;
                }

                .custom-checkbox input[type="checkbox"]:checked+label:after {
                    border-color: #fff;
                }

                .custom-checkbox input[type="checkbox"]:disabled+label:before {
                    color: #b8b8b8;
                    cursor: auto;
                    box-shadow: none;
                    background: #ddd;
                }

                /* Modal styles */
                .modal .modal-dialog {
                    max-width: 400px;
                }

                .modal .modal-header,
                .modal .modal-body,
                .modal .modal-footer {
                    padding: 20px 30px;
                }

                .modal .modal-content {
                    border-radius: 3px;
                    font-size: 14px;
                }

                .modal .modal-footer {
                    background: #ecf0f1;
                    border-radius: 0 0 3px 3px;
                }

                .modal .modal-title {
                    display: inline-block;
                }

                .modal .form-control {
                    border-radius: 2px;
                    box-shadow: none;
                    border-color: #dddddd;
                }

                .modal textarea.form-control {
                    resize: vertical;
                }

                .modal .btn {
                    border-radius: 2px;
                    min-width: 100px;
                }

                .modal form label {
                    font-weight: normal;
                }
            </style>
            <script>
                $(document).ready(function() {
                    // Activate tooltip
                    $('[data-toggle="tooltip"]').tooltip();

                    // Select/Deselect checkboxes
                    var checkbox = $('table tbody input[type="checkbox"]');
                    $("#selectAll").click(function() {
                        if (this.checked) {
                            checkbox.each(function() {
                                this.checked = true;
                            });
                        } else {
                            checkbox.each(function() {
                                this.checked = false;
                            });
                        }
                    });
                    checkbox.click(function() {
                        if (!this.checked) {
                            $("#selectAll").prop("checked", false);
                        }
                    });
                });
            </script>



            <?php
            include('includes/script.php');
            include('includes/footer.php');
            ?>