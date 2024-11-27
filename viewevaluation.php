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

$teacher_id = isset($_GET['teacher_id']) ? mysqli_real_escape_string($con, $_GET['teacher_id']) : '';
$student_id = isset($_GET['student_id']) ? mysqli_real_escape_string($con, $_GET['student_id']) : '';

// Fetch evaluation details
$eval_query = "SELECT * FROM evaluation_form WHERE teacher_id = '$teacher_id' AND user_id = '$student_id'";
$eval_result = mysqli_query($con, $eval_query);
$evaluation = mysqli_fetch_assoc($eval_result);

// Fetch teacher details
$teacher_query = "SELECT * FROM teacher WHERE id = '$teacher_id'";
$teacher_result = mysqli_query($con, $teacher_query);
$teacher = mysqli_fetch_assoc($teacher_result);

// Fetch questions from database
$questions_query = "SELECT * FROM questions ORDER BY id";
$questions_result = mysqli_query($con, $questions_query);

// Calculate average rating and count occurrences of each rating
$total_questions = mysqli_num_rows($questions_result);
$sum_ratings = 0;
$answered_questions = 0;
$rating_counts = array_fill(1, 5, 0);

for ($i = 1; $i <= $total_questions; $i++) {
    if (isset($evaluation['Q'.$i]) && is_numeric($evaluation['Q'.$i])) {
        $rating = (int)$evaluation['Q'.$i];
        $sum_ratings += $rating;
        $answered_questions++;
        if ($rating >= 1 && $rating <= 5) {
            $rating_counts[$rating]++;
        }
    }
}

$avg_rating = $answered_questions > 0 ? round($sum_ratings / $answered_questions, 2) : 0;

// Reset the result pointer
mysqli_data_seek($questions_result, 0);

function getRatingStatus($rating) {
    if ($rating >= 4.5) return 'Excellent';
    if ($rating >= 3.5) return 'Good';
    if ($rating >= 2.5) return 'Average';
    if ($rating >= 1.5) return 'Below Average';
    return 'Poor';
}

$rating_status = getRatingStatus($avg_rating);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Evaluation</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .container {
            display: flex;
            max-width: 1300px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
    
        }
        .evaluation-details {
            flex: 2;
            
            height: 1000px;
            border-right: 1px solid #ddd;
        }
        .graph-container {
            flex: 1;
            padding: 20px;
            height: 1000px;
            display: flex;
            flex-direction: column;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        .chart-wrapper {
            height: 400px;
            width: 100%;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .status {
            font-weight: bold;
            color: #4CAF50;
        }
        .rating-section {
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            
        }

        .rating-section h2 {
            font-size: 20px;
     
        }

    </style>
</head>
<body>
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

       




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
    <div class="container">
    <div class="evaluation-details">
        <?php if ($teacher && $evaluation): ?>
            <div class="rating-section">
                <h2>Rating Scale</h2>
                <div class="rating-buttons">
                    <button class="btn-primary" onclick="rateCourse(5)">5 - Outstanding</button>
                    <button class="btn-success" onclick="rateCourse(4)">4 - Very Good</button>
                    <button class="btn-info" onclick="rateCourse(3)">3 - Good</button>
                    <button class="btn-warning" onclick="rateCourse(2)">2 - Fair</button>
                    <button class="btn-danger" onclick="rateCourse(1)">1 - Poor</button>
                </div>
            </div>
            <table>
                <tr>
                    <th>Question</th>
                    <th>Rating</th>
                </tr>
                <?php 
                $i = 1;
                while ($question = mysqli_fetch_assoc($questions_result)): 
                ?>
                    <tr>
                        <td><?= htmlspecialchars($question['question_text']) ?></td>
                        <td>
                            <?= isset($evaluation['Q'.$i]) ? htmlspecialchars($evaluation['Q'.$i]) : 'N/A' ?>
                        </td>
                    </tr>
                <?php 
                $i++;
                endwhile; 
                ?>
            </table>
            <!-- Display teacher feedback if available -->
            <!-- Display teacher feedback if available -->
<div class="teacher-feedback">
    <h3>Feedback:</h3>
    <p><?= htmlspecialchars($evaluation['teacher_feedback'] ?? 'No feedback provided.') ?></p>
</div>

<style>
    .teacher-feedback {
        background-color: #f4f4f9;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 20px;
        margin: 20px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: 'Arial', sans-serif;
        color: #333;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .teacher-feedback:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .teacher-feedback h3 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #4caf50;
        margin-bottom: 15px;
    }

    .teacher-feedback p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: #555;
    }

    .teacher-feedback p::before {
        content: "💬 ";
        font-size: 1.4rem;
        color: #4caf50;
    }

    .teacher-feedback p::after {
       
        font-size: 1.4rem;
        color: #4caf50;
    }

    .teacher-feedback p:empty::before {
        content: "🔒 ";
    }

    .teacher-feedback p:empty::after {
        content: "";
    }
</style>

        <?php else: ?>
            <p>No evaluation data found for this teacher and student.</p>
        <?php endif; ?>
    </div>

    <div class="graph-container">
        <h2>Rating Distribution</h2>
        <div class="chart-wrapper">
            <canvas id="ratingChart"></canvas>
        </div>

        <?php if ($teacher && $evaluation): ?>
            <table>
                <tr>
                    <th>Subject</th>
                    <td><?= htmlspecialchars($teacher['Tsubject'] ?? 'N/A') ?></td>
                </tr>
                
                <tr>
                    <th>Average Rating</th>
                    <td><?= $avg_rating ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><span class="status"><?= $rating_status ?></span></td>
                </tr>
            </table>
        <?php endif; ?>
    </div>
</div>
</div>

<script>
    var ctx = document.getElementById('ratingChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1 (SD)', '2 (D)', '3 (U)', '4 (A)', '5 (SA)'],
            datasets: [{
                data: [<?= implode(',', $rating_counts) ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(255, 205, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(54, 162, 235, 0.8)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Responses',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Rating Categories',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
</body>
</html>