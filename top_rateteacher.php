<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Login Data</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<?php

include 'dbcon.php';
session_start();


// Assuming this is your login verification logic
if ($login_success) {
    $_SESSION['id'] = $user_id; // Set user id in session
    $_SESSION['username'] = $username; // Set username in session
    $_SESSION['password'] = $password; // Set password in session (or a hashed password/token for security)
    header('Location: Teacher.php'); // Redirect to a logged-in page after successful login
    exit();
}
include('includes/header.php');
include('includes/navbar.php');
include('message.php');

// Function to get top teachers by branch
function getTopTeachersByBranch($con, $branch, $limit = 10)
{
    $query = "SELECT t.id, t.Tname, t.Tsubject,
                        AVG((ef.Q1 + ef.Q2 + ef.Q3 + ef.Q4 + ef.Q5 + ef.Q6 + ef.Q7 + ef.Q8 + ef.Q9) / 9 * 20) as average_rating
                FROM teacher t
                JOIN evaluation_form ef ON t.id = ef.teacher_id
                WHERE t.Branch = '$branch'
                GROUP BY t.id
                ORDER BY average_rating DESC
                LIMIT $limit";

    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }
    return $result;
}



// Modified function to display top 3 teachers in a box
function displayTop3TeachersBox($con, $branch)
{
    $top_teachers = getTopTeachersByBranch($con, $branch, 3);
    $medal_colors = ['gold', 'silver', '#cd7f32']; // Gold, Silver, Bronze
?>
    <div class="col-xl-6 col-lg-6 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Top 3 Teachers - <?= $branch ?></h6>
            </div>
            <div class="card-body">
                <?php
                $rank = 1;
                while ($teacher = mysqli_fetch_assoc($top_teachers)) :
                ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-medal mr-2" style="color: <?= $medal_colors[$rank - 1] ?>;"></i>
                                <span class="font-weight-bold"><?= htmlspecialchars($teacher['Tname']) ?></span>
                                <small class="text-muted ml-2"><?= htmlspecialchars($teacher['Tsubject']) ?></small>
                            </div>
                            <div class="text-right">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= round($teacher['average_rating'], 1) ?></div>
                                <div class="text-xs text-gray-500">out of 100</div>
                            </div>
                        </div>
                        <div class="progress mt-2" style="height: 10px;">
                            <div class="progress-bar bg-<?= $branch === 'Granby College' ? 'primary' : 'success' ?>"
                                role="progressbar"
                                style="width: <?= $teacher['average_rating'] ?>%;"
                                aria-valuenow="<?= round($teacher['average_rating'], 2) ?>"
                                aria-valuemin="0"
                                aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                <?php
                    $rank++;
                endwhile;
                ?>
            </div>
        </div>
    </div>
<?php
}

// Function to display top teachers table
function displayTopTeachersTable($con, $branch, $limit = 1000)
{
    $teachers = getTopTeachersByBranch($con, $branch, $limit);
    $rank = 1;
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Top Teachers - <?= $branch ?></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered topTeachersTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($teacher = mysqli_fetch_assoc($teachers)):
                            $medal_class = '';
                            if ($rank <= 3) {
                                $medal_class = ['gold', 'silver', 'bronze'][$rank - 1];
                            }
                        ?>
                            <tr>
                                <td>
                                    <?= $rank ?>
                                    <?php if ($medal_class): ?>
                                        <i class="fas fa-medal <?= $medal_class ?>-medal"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($teacher['Tname']) ?></td>
                                <td><?= htmlspecialchars($teacher['Tsubject']) ?></td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar bg-<?= $branch === 'Granby College' ? 'primary' : 'success' ?>"
                                            role="progressbar"
                                            style="width: <?= $teacher['average_rating'] ?>%;"
                                            aria-valuenow="<?= round($teacher['average_rating'], 2) ?>"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                            <?= round($teacher['average_rating'], 2) ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            $rank++;
                        endwhile;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
}
$branches = ['Granby College'];
$show_more = isset($_GET['show_more']) && $_GET['show_more'] == 'true';

?>

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


        </nav>


        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">
                    <i class="fas fa-trophy mr-2 text-warning"></i>
                    Top Rated Teachers
                </h1>
            </div>

            <?php if (!$show_more): ?>
                <!-- Display Top 3 Teachers Boxes -->
                <div class="row">
                    <?php
                    foreach ($branches as $branch) {
                        displayTop3TeachersBox($con, $branch);
                    }
                    ?>
                </div>

                <div class="text-center mb-4">
                    <a href="?show_more=true" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-list"></i>
                        </span>
                        <span class="text">Show All Teachers</span>
                    </a>
                </div>
            <?php else: ?>
                <!-- Display Full Tables -->
                <?php
                foreach ($branches as $branch) {
                    displayTopTeachersTable($con, $branch);
                }
                ?>
                <div class="text-center mb-4">
                    <a href="top_rateteacher.php" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Back to Top 3</span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        <?php if ($show_more): ?>
            $('.topTeachersTable').DataTable({
                "pageLength": 10,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [
                    [3, "desc"]
                ],
                "columnDefs": [{
                        "orderable": false,
                        "targets": 0
                    },
                    {
                        "type": "num",
                        "targets": 3
                    }
                ]
            });
        <?php endif; ?>
    });
</script>

<style>
    .progress-bar {
        transition: width 0.6s ease;
    }

    .gold-medal {
        color: gold;
    }

    .silver-medal {
        color: silver;
    }

    .bronze-medal {
        color: #cd7f32;
    }

    .topTeachersTable td {
        vertical-align: middle;
    }
</style>