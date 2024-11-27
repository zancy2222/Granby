<?php
include('dbcon.php');
session_start();

$con = mysqli_connect("localhost", "root", "", "4502397_demo");
if (!$con) {
    error_log("Failed to connect to MySQL: " . mysqli_connect_error());
    header("Location: error.php");
    exit();
}
include('includes/header.php');
include('includes/navbar.php');
include('message.php');
// Pagination
$entriesPerPage = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $entriesPerPage;

$sql = "SELECT id_student, pass, Cpass, CONCAT(Fname, ' ', Mname, ' ', Lname, ' ', Suffix) AS full_name, Branch, Course, Section FROM slogin LIMIT $start, $entriesPerPage";
$result = mysqli_query($con, $sql);

$totalEntriesQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM slogin");
$totalEntries = mysqli_fetch_assoc($totalEntriesQuery)['total'];
$totalPages = ceil($totalEntries / $entriesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            color: #333;
        }
        .container-fluid {
            padding: 10px;
        }
        .table-wrapper {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .table-title {
            background: linear-gradient(45deg, #3a7bd5, #00d2ff);
            color: #fff;
            padding: 20px;
            margin: -20px -20px 20px;
            border-radius: 10px 10px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
            font-weight: 600;
        }
        table.table {
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        table.table thead th {
            border: none;
            background-color: #f8f9fa;
            color: #333;
            font-weight: 600;
            text-transform: uppercase;
            padding: 10px;
            font-size: 15px;
        }
        table.table tbody td {
            border: none;
            background-color: #fff;
            padding: 5px;
            vertical-align: middle;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        table.table tbody tr {
            transition: all 0.3s ease;
        }
        table.table tbody tr:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .pagination {
            margin-top: 20px;
        }
        .page-item.active .page-link {
            background-color: #3a7bd5;
            border-color: #3a7bd5;
        }
        .page-link {
            color: #3a7bd5;
        }
        .hint-text {
            font-size: 13px;
            margin-top: 10px;
        }
        .no-results {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2><i class="fas fa-user-graduate me-2"></i>Student Login Data</h2>
                    </div>
                </div>
            </div>
            <?php
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='table table-hover'>
                <thead>
                    <tr>
                        <th><i class='fas fa-id-card me-2'></i>ID</th>
                        <th><i class='fas fa-user me-2'></i>Full Name</th>
                        <th><i class='fas fa-graduation-cap me-2'></i>Course</th>
                        <th><i class='fas fa-chalkboard me-2'></i>Section</th>
                    </tr>
                </thead>
                <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id_student"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["full_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Course"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Section"]) . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='no-results'>No results found</p>";
            }
            ?>
            <div class="clearfix">
                
                <ul class="pagination">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                        <a href="?page=<?= $page - 1; ?>" class="page-link"><i class="fa fa-angle-double-left"></i></a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                            <a href="?page=<?= $i; ?>" class="page-link"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                        <a href="?page=<?= $page + 1; ?>" class="page-link"><i class="fa fa-angle-double-right"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($con);
?>
