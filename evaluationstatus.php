<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css" rel="stylesheet">
<?php
require 'dbcon.php';
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

// Check if the table exists, if not, create it
$tableCheckQuery = "SHOW TABLES LIKE 'evaluation_status'";
$tableResult = mysqli_query($con, $tableCheckQuery);
if (mysqli_num_rows($tableResult) == 0) {
    $createTableQuery = "CREATE TABLE evaluation_status (
        id INT AUTO_INCREMENT PRIMARY KEY,
        status VARCHAR(50) NOT NULL,
        last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    mysqli_query($con, $createTableQuery);
    echo "<div class='alert alert-success'>Table 'evaluation_status' created.</div>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newStatus = $_POST['status'];
    $updateQuery = "INSERT INTO evaluation_status (status) VALUES ('$newStatus')";
    $updateSuccess = false;
if (mysqli_query($con, $updateQuery)) {
    $updateSuccess = true;
} else {
    echo "<div class='alert alert-danger'>Error updating status: " . mysqli_error($con) . "</div>";
}
}

$statusQuery = "SELECT status FROM evaluation_status ORDER BY last_updated DESC LIMIT 1";
$statusResult = mysqli_query($con, $statusQuery);

if ($statusResult && mysqli_num_rows($statusResult) > 0) {
    $currentStatus = mysqli_fetch_assoc($statusResult)['status'];
} else {
    $currentStatus = 'closed'; // Default status when table is empty
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Update Evaluation Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }
        body {
            font-family: 'Poppins', sans-serif;
           
        }
        .content-wrapper {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            padding: 2rem;
            max-width: 1200px;
            width: 100%;
        }
        .navbar-brand {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: block;
            text-align: center;
        }
        h2 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .form-label {
            font-weight: 500;
            color: var(--secondary-color);
        }
        .form-control, .form-select {
            border-radius: 0.5rem;
            border: 1px solid #d1d3e2;
            padding: 0.75rem;
            width: 30%;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
            transform: translateY(-2px);
        }
        .alert {
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .status-badge {
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.35em 0.65em;
            border-radius: 0.25rem;
            text-transform: uppercase;
        }
        .status-badge.ongoing {
            background-color: var(--info-color);
            color: white;
        }
        .status-badge.closed {
            background-color: var(--secondary-color);
            color: white;
        }
        .evaluation-visual {
            position: relative;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 2rem;
        }
        .progress-circle {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(145deg, var(--primary-color), var(--info-color));
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            z-index: 2;
            transition: all 0.3s ease;
        }
        .progress-circle:hover {
            transform: scale(1.05);
        }
        .progress-circle-inner {
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .progress-circle-inner i {
            font-size: 35px;
            color: var(--primary-color);
        }
        .status-line {
            position: absolute;
            height: 6px;
            width: 40%;
            top: 50%;
            transform: translateY(-50%);
            transition: all 0.3s ease;
        }
        .status-line.ongoing {
            left: 0;
            background: linear-gradient(90deg, var(--info-color), var(--primary-color));
        }
        .status-line.closed {
            right: 0;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }
    </style>
</head>
<body>

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        </nav>
    <div class="container">
        <div class="content-wrapper">
            <a class="navbar-brand" href="#"><i class="fas fa-chart-line me-2"></i>EvalStatus</a>
            <h2><i class="fas fa-sync-alt me-2"></i>Update Evaluation Status</h2>
            <div class="alert alert-info">
                Current status: <span class="status-badge <?php echo $currentStatus; ?>"><?php echo ucfirst($currentStatus); ?></span>
            </div>
            <form method="POST">
                <div class="mb-3">
                    <label for="status" class="form-label">New Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="ongoing" <?php echo ($currentStatus == 'ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                        <option value="closed" <?php echo ($currentStatus == 'closed') ? 'selected' : ''; ?>>Closed</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-check me-2"></i>Update Status</button>
                </div>
            </form>
            
            <div class="evaluation-visual">
                <div class="progress-circle">
                    <div class="progress-circle-inner">
                        <i class="fas fa-tasks"></i>
                    </div>
                </div>
                <div class="status-line ongoing"></div>
                <div class="status-line closed"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    <?php if ($updateSuccess): ?>
    Swal.fire({
        title: 'Success!',
        text: 'Status Updated Successfully.',
        icon: 'success',
        confirmButtonText: 'OK'
    });
    <?php endif; ?>
    </script>
</body>
</html>