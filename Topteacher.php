<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/logobg.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Student Dashboard Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>
<style>

.container-fluid {
    margin-top: 20px;
    max-width: 1200px; /* Limit the container width */
    margin-left: auto;
    margin-right: auto;
}

.card {
    border-radius: 10px; /* Rounded corners for cards */
}

.card-header {

    color: white;
}

.card-body {
    background-color: #f8f9fc;
}

.row {
    display: flex;
    justify-content: center; /* Center align the content */
    gap: 20px;
}

.col-xl-6 {
    width: 100%;
    max-width: 800px; /* Wider max width for the cards */
}

.card-body .d-flex {
    margin-bottom: 15px;
}

.progress-bar {
    transition: width 0.5s ease-in-out;
}

.card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .card-header {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
        }
        .medal-icon {
            font-size: 1.25rem;
            vertical-align: middle;
        }
        .text-primary {
            color: #4e73df !important;
        }
        .text-gray-800 {
            color: #5a5c69 !important;
        }
        .text-gray-500 {
            color: #858796 !important;
        }
</style>
<body>
    
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="img/logobg.png" alt="">
            </div>
            <span class="logo_name">Evaluation</span>
        </div>
        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="Topteacher.php"><i class="uil uil-chart"></i><span class="link-name">Dashboard</span></a></li>
                <li><a href="test.php"><i class="uil uil-estate"></i><span class="link-name">Evaluation</span></a></li>
                <li><a href="StudentProfile.php"><i class="uil uil-files-landscapes"></i><span class="link-name">Profile</span></a></li>
                <li><a href="Schangepass.php"><i class="uil uil-chart"></i><span class="link-name">Change password</span></a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="logout.php"><i class="uil uil-signout"></i><span class="link-name">Logout</span></a></li>
                <li class="mode">
                    <a href="#"><i class="uil uil-moon"></i><span class="link-name">Dark Mode</span></a>
                    <div class="mode-toggle"><span class="switch"></span></div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <?php
            include 'dbcon.php';
            session_start();

            function getTopTeachersByBranch($con, $branch, $limit = 10) {
                $query = "
                    SELECT 
                        t.id AS teacher_id, 
                        t.Tname AS TeacherName, 
                        t.Tsubject AS Subject,
                        COUNT(ef.user_id) AS student_votes
                    FROM 
                        teacher t
                    JOIN 
                        evaluation_form ef ON t.id = ef.teacher_id
                    WHERE 
                        t.Branch = ?
                    GROUP BY 
                        t.id, t.Tname, t.Tsubject
                    ORDER BY 
                        student_votes DESC
                    LIMIT ?";
                
                $stmt = $con->prepare($query);
                $stmt->bind_param('si', $branch, $limit);
                $stmt->execute();
                $result = $stmt->get_result();
                if (!$result) {
                    die("Query failed: " . $stmt->error);
                }
                return $result;
            }

            function displayTop10TeachersBox($con, $branch) {
                $top_teachers = getTopTeachersByBranch($con, $branch, 10);
            ?>
                <div class="col-12 mb-4 d-flex justify-content-center">
                    <div class="card shadow h-100 w-75">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold">Top 10 Teachers - <?= htmlspecialchars($branch) ?></h6>
                        </div>
                        <div class="card-body">
                            <?php
                            $rank = 1;
                            while ($teacher = $top_teachers->fetch_assoc()) :
                                $medal_color = $rank <= 3 ? ['gold', 'silver', '#cd7f32'][$rank - 1] : '#adb5bd'; // Medals for top 3
                            ?>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-medal medal-icon mr-2" style="color: <?= $medal_color ?>;"></i>
                                            <span class="font-weight-bold"><?= htmlspecialchars($teacher['TeacherName']) ?></span>
                                            <small class="text-muted ml-2"><?= htmlspecialchars($teacher['Subject']) ?></small>
                                        </div>
                                        <div class="text-right">
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $teacher['student_votes'] ?> Votes</div>
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

            // Display top teachers for Granby College
            displayTop10TeachersBox($con, 'Granby College');
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>
</html>


    <style>
        .my-swal-button {
    padding: 10px 20px;
    font-size: 16px;
    width: auto; /* Ensures it fits the button text */
}

.my-swal-popup {
    min-width: 300px; /* Adjust width as necessary */
    padding: 20px;
}

        @media screen and (max-width: 500px) {
            .swal2-popup {
                width: 90% !important;
                padding: 1rem !important;
            }

            .swal2-title {
                font-size: 1.2rem !important;
            }

            .swal2-text {
                font-size: 0.9rem !important;
            }

            .swal2-confirm {
                font-size: 0.9rem !important;
                padding: 0.5rem 1rem !important;
            }
        }


        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .evaluation-info {
            background-color: #ECECEC;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 10px;
        }

        .evaluation-info h2 {
            font-size: 20px;
            margin-bottom: 5px;
            color: #007bff;
        }

        .evaluation-info p {
            font-size: 16px;
            color: #555;
        }

        .evaluation-progress {
            margin-bottom: 10px;
        }

        .progress-bar {
            background-color: #e9ecef;
            border-radius: 4px;
            height: 20px;
            overflow: hidden;
        }

        .progress {
            background-color: #007bff;
            height: 100%;
            transition: width 0.5s ease-in-out;
        }

        .evaluation-progress p {
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #333;
        }

        .teacher-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .btn-evaluate {
            display: inline-block;
            padding: 8px 16px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-evaluate:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .table thead {
                display: none;
            }

            .table,
            .table tbody,
            .table tr,
            .table td {
                display: block;
                width: 100%;
            }

            .table tr {
                margin-bottom: 15px;
            }

            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }

            .teacher-image {
                margin: 0 auto;
                display: block;
            }
        }

        .btn-custom {
            font-style: normal;
            text-align: center;
            padding: 4px 8px;
            width: auto;
            font-family: Arial, sans-serif;
            background-color: #245580;
            font-size: 12px;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            display: block;
            cursor: pointer;
            text-decoration: none;
            line-height: normal;
            height: auto;
            white-space: nowrap;
        }
    </style>

    <script src="script.js"></script>
</body>

</html>
<style>
    /* ===== Google Font Import - Poppins ===== */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    :root {
        /* ===== Colors ===== */
        --primary-color: #0E4BF1;
        --panel-color: #FFC96F;
        --text-color: #000;
        --black-light-color: #707070;
        --border-color: #e6e5e5;
        --toggle-color: #DDD;
        --box1-color: #4DA3FF;
        --box2-color: #FFE6AC;
        --box3-color: #E7D1FC;
        --title-icon-color: #fff;
        --dark-bluee: #000080;
        --dark-blue: #245580;
        --dark-yellow: #B8860B;

        /* ====== Transition ====== */
        --tran-05: all 0.5s ease;
        --tran-03: all 0.3s ease;
        --tran-03: all 0.2s ease;
    }

    body {
    background-image: url('img/background.jpg'); /* Path to your image */
    background-size: cover; /* Cover the entire screen */
    background-position: center center; /* Center the background image */
    background-attachment: fixed; /* Keeps the background fixed while scrolling */
    font-family: Arial, sans-serif; /* Optional: Adjust font */
}

    body.dark {
        --primary-color: #3A3B3C;
        --panel-color: #242526;
        --text-color: #CCC;
        --black-light-color: #CCC;
        --border-color: #4D4C4C;
        --toggle-color: #FFF;
        --box1-color: #3A3B3C;
        --box2-color: #3A3B3C;
        --box3-color: #3A3B3C;
        --title-icon-color: #CCC;
    }

    /* === Custom Scroll Bar CSS === */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #0b3cc1;
    }

    body.dark::-webkit-scrollbar-thumb:hover,
    body.dark .activity-data::-webkit-scrollbar-thumb:hover {
        background: #3A3B3C;
    }

    nav {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        padding: 10px 14px;

        border-right: 1px solid var(--border-color);
        transition: var(--tran-05);
    }

    nav.close {
        width: 73px;
    }

    nav .logo-name {
        display: flex;
        align-items: center;
    }

    nav .logo-image {
        display: flex;
        justify-content: center;
        min-width: 55px;
    }

    nav .logo-image img {
        width: 55px;
        object-fit: cover;
        border-radius: 50%;
    }

    nav .logo-name .logo_name {
        font-size: 22px;
        font-weight: 600;
        color: var(--text-color);
        margin-left: 14px;
        transition: var(--tran-05);
    }

    nav.close .logo_name {
        opacity: 0;
        pointer-events: none;
    }

    nav .menu-items {
        margin-top: 40px;
        height: calc(100% - 90px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .menu-items li {
        list-style: none;
    }

    .menu-items li a {
        display: flex;
        align-items: center;
        height: 50px;
        text-decoration: none;
        position: relative;
    }

    .nav-links li a:hover:before {
        content: "";
        position: absolute;
        left: -7px;
        height: 5px;
        width: 5px;
        border-radius: 50%;
        background-color: var(--primary-color);
    }

    body.dark li a:hover:before {
        background-color: var(--text-color);
    }

    .menu-items li a i {
        font-size: 24px;
        min-width: 45px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--black-light-color);
    }

    .menu-items li a .link-name {
        font-size: 18px;
        font-weight: 400;
        color: var(--black-light-color);
        transition: var(--tran-05);
    }

    nav.close li a .link-name {
        opacity: 0;
        pointer-events: none;
    }

    .nav-links li a:hover i,
    .nav-links li a:hover .link-name {
        color: var(--primary-color);
    }

    body.dark .nav-links li a:hover i,
    body.dark .nav-links li a:hover .link-name {
        color: var(--text-color);
    }

    .menu-items .logout-mode {
        padding-top: 10px;
        border-top: 1px solid var(--border-color);
    }

    .menu-items .mode {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .menu-items .mode-toggle {
        position: absolute;
        right: 14px;
        height: 50px;
        min-width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .mode-toggle .switch {
        position: relative;
        display: inline-block;
        height: 22px;
        width: 40px;
        border-radius: 25px;
        background-color: var(--toggle-color);
    }

    .switch:before {
        content: "";
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        height: 15px;
        width: 15px;

        border-radius: 50%;
        transition: var(--tran-03);
    }

    body.dark .switch:before {
        left: 20px;
    }

    .dashboard {

        position: relative;
        left: 0;
        background-image: url(img/background1.jpg);
        /* Changed from red to use your theme color */
        min-height: 100vh;
        width: 100%;
        padding: 10px;
        transition: var(--tran-05);
    }

    nav.close~.dashboard {
        left: 0;
        width: 100%;
    }

    .dashboard .top {
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        width: 100%;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: white;
        transition: var(--tran-05);
        z-index: 10;
    }

    .dashboard .top .sidebar-toggle {
        font-size: 24px;
        color: var(--text-color);
        cursor: pointer;
    }

    .dashboard .top .search-box {
        position: relative;
        height: 40px;
        max-width: 400px;
        width: 100%;
        margin: 0 15px;
    }

    .top .search-box input {
        width: 100%;
        height: 100%;
        padding: 0 35px 0 15px;
        font-size: 14px;
    }

    .top .search-box i {
        font-size: 18px;
    }

    .top img {
        width: 35px;
    }

    .dashboard .dash-content {
        padding-top: 60px;
    }

    .dash-content .title {
        margin: 30px 0 20px 0;
    }

    .dash-content .title i {
        height: 30px;
        width: 30px;
        font-size: 20px;
    }

    .dash-content .title .text {
        font-size: 20px;
    }

    .dash-content .boxes {
        flex-direction: column;
    }

    .dash-content .boxes .box {
        width: 100%;
        margin-bottom: 15px;
    }

    .boxes .box i {
        font-size: 28px;
    }

    .boxes .box .text {
        font-size: 16px;
    }

    .boxes .box .number {
        font-size: 32px;
    }

    .activity .activity-data {
        flex-direction: column;
        align-items: flex-start;
    }

    .activity-data .data {
        margin: 10px 0;
    }

    @media (min-width: 768px) {
        .dashboard {
            left: 250px;
            width: calc(100% - 250px);
        }

        nav.close~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        .dashboard .top {
            left: 250px;
            width: calc(100% - 250px);
        }

        nav.close~.dashboard .top {
            left: 73px;
            width: calc(100% - 73px);
        }

        .dash-content .boxes {
            flex-direction: row;
        }

        .dash-content .boxes .box {
            width: calc(33.33% - 15px);
        }

        .activity .activity-data {
            flex-direction: row;
        }
    }

    @media (max-width: 1000px) {
        nav {
            width: 73px;
        }

        nav.close {
            width: 250px;
        }

        nav .logo_name,
        nav li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close .logo_name,
        nav.close li a .link-name {
            opacity: 1;
            pointer-events: auto;
        }
    }

    @media (max-width: 560px) {
        .container {
            margin-top: 15%;
        }

        .table-wrapper {
            padding: 10px;
        }

        .table-title {
            padding: 10px 15px;
        }
    }

    @media (max-width: 470px) {

        .container {
            margin-top: 20%;


        }

        nav,
        nav.close {
            width: 0;
        }

        nav .logo_name,
        nav.close .logo_name,
        nav li a .link-name,
        nav.close li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        .dashboard,
        nav.close~.dashboard,
        .dashboard .top,
        nav.close~.dashboard .top {
            left: 0;
            width: 100%;
        }

        .container {
            margin-top: 20%;
            width: 100%;
        }

        .btn-subject {
            width: 100%;
            margin-bottom: 10px;
        }
    }

    .btn-subject {
        font-style: normal;
        text-align: center;
        /* Center-align text horizontally */
        padding: 4px 8px;
        /* Padding for button size */
        width: auto;
        /* Fit button to text width */
        font-family: Arial, sans-serif;
        background-color: #245580;
        font-size: 12px;
        /* Small font size */
        color: white;
        /* Text color for visibility */
        border: none;
        /* Remove default border */
        border-radius: 4px;
        /* Rounded corners */
        display: inline-block;
        /* Inline element */
        cursor: pointer;
        /* Pointer cursor on hover */
        text-decoration: none;
        /* Remove text underline */
        line-height: normal;
        /* Normal line height */
        height: auto;
        /* Auto height to fit content */

        /* Align text vertically */
        white-space: nowrap;
        /* Prevent text wrapping */
        display: block;
    }



    /* Optional: Additional hover effect for better UX */
    .btn-subject:hover {
        background-color: #1b4264;
    }


    body {


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
        padding: 5px 10px;
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
        color: white;
        display: inline-block;
        text-decoration: none;
        outline: none !important;
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



    @media (max-width: 1000px) {
        nav {
            width: 73px;
        }

        nav.close {
            width: 250px;
        }

        nav .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close .logo_name {
            opacity: 1;
            pointer-events: auto;
        }

        nav li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close li a .link-name {
            opacity: 1;
            pointer-events: auto;
        }

        nav~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        nav.close~.dashboard {
            left: 250px;
            width: calc(100% - 250px);
        }

        nav~.dashboard .top {
            left: 73px;
            width: calc(100% - 73px);
        }

        nav.close~.dashboard .top {
            left: 250px;
            width: calc(100% - 250px);
        }

        .activity .activity-data {
            overflow-X: scroll;
        }
    }

    @media (max-width: 780px) {
        .dash-content .boxes .box {
            width: calc(100% / 2 - 15px);
            margin-top: 15px;
        }
    }

    @media (max-width: 560px) {
        .dash-content .boxes .box {
            width: 100%;
        }
    }

    @media (max-width: 470px) {

        td {
            font-size: 11.5px;
            font-weight: 500;

        }


        .container {
            margin-top: 20%;


        }

        nav {
            width: 0px;
        }

        nav.close {
            width: 73px;
        }

        nav .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        nav li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        nav~.dashboard {
            left: 0;
            width: 100%;
        }

        nav.close~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        nav~.dashboard .top {
            left: 0;
            width: 100%;
        }

        nav.close~.dashboard .top {
            left: 0;
            width: 100%;
        }
    }

    .container {
        margin-top: 10%;
        max-width: 800px;
        width: 100%;
        background-color: #fff;
        padding: 25px 30px;

        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        border: 3px solid;
        /* Set the border width */
        border-image: linear-gradient(100deg, var(--dark-blue), var(--dark-yellow)) 1;
        /* Add some padding to see the effect */
        /* Center the text inside the div */

    }

    .container .title {
        font-size: 25px;
        font-weight: 500;
        position: relative;
    }

    .container .title::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        border-radius: 5px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .content form .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    form .user-details .input-box {
        margin-bottom: 15px;
        width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .user-details .input-box input {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid {
        border-color: #B8860B;
    }

    form .button {
        height: 45px;
        margin: 35px 0
    }

    form .button input {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    form .button input:hover {
        background: linear-gradient(-135deg, #71b7e6, #9b59b6);
    }

    @media(max-width: 310px) {



        .container {
            margin-top: 20%;
            width: 120%;

        }

        .btn-subject {
            text-align: left;
            padding: 10px 10px;
            width: auto;
            height: auto;
            font-family: Arial, sans-serif;
            background-color: #245580;
            font-size: 12px;
            color: white;
            border: none;
            border-radius: 5px;
            display: inline-block;
            cursor: pointer;
            text-decoration: none;
            line-height: normal;
            white-space: nowrap;
        }


        form .user-details .input-box {
            margin-bottom: 15px;
            width: 100%;
        }

        .content form .user-details {
            max-height: 300px;
            overflow-y: scroll;
            background-image: url(img/background1.jpg);
        }

        .user-details::-webkit-scrollbar {
            width: 5px;
        }
    }

    @media(max-width: 490px) {
        .navbar {

            display: none;
        }

        .container {
            margin-top: 20%;


        }

        .container .content .category {
            flex-direction: column;
        }
    }

    .progressbar {
        position: relative;
        display: flex;
        justify-content: space-between;
        counter-reset: step;
        margin: 2rem 0 4rem;
    }

    .progressbar::before,
    .progress {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        background-color: #dcdcdc;
        z-index: 1;
    }

    .progress {
        background-color: #B8860B;
        width: 0%;
        transition: 0.3s;
    }

    .progress-step {
        width: 2.1875rem;
        height: 2.1875rem;
        background-color: #dcdcdc;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .progress-step::before {
        counter-increment: step;
        content: counter(step);
    }

    .progress-step::after {
        content: attr(data-title);
        position: absolute;
        top: calc(100% + 0.5rem);
        font-size: 0.85rem;
        color: #666;
    }

    .progress-step-active {
        background-color: #245580;
        color: #f3f3f3;
    }

    .step-forms {
        display: none;
    }

    .step-forms-active {
        display: block;
    }

    .btns-group {
        display: flex;
        justify-content: space-between;
    }

    .btn {
        padding: 0.75rem;
        text-decoration: none;
        background-color: #245580;
        color: #fff;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: 0.3s;
    }



    .input-box {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        width: max-content;
        /* Adjust width */
        overflow-y: auto;
        max-height: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .gradient-border {
        border: 5px solid;
        /* Set the border width */
        border-image: linear-gradient(100deg, var(--dark-blue), var(--dark-yellow)) 1;
        padding: 20px;
        /* Add some padding to see the effect */
        text-align: center;
        /* Center the text inside the div */
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        margin: 20px 0;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        background-color: #f8f9fa;
        padding: 15px;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: 14px;
        background-color: white;
    }

    thead {
        background-color: #245580;
        color: white;
    }

    th,
    td {
        padding: 12px 15px;

        border-bottom: 2px solid #e0e0e0;
    }

    th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    tbody tr:hover {
        background-color: #f5f5f5;
    }

    td img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .btn-custom {
        background-color: #245580;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        transition: background-color 0.3s ease;
        font-size: 12px;
    }

    .btn-custom:hover {
        background-color: #1b3f5f;
    }

    @media screen and (max-width: 600px) {
        .table-responsive {
            max-height: 400px;
            /* Adjust this value as needed */
            overflow-y: auto;
        }

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        td {
            border: none;
            position: relative;
            padding-left: 50%;
            text-align: right;
            min-height: 10px;
            /* Add this to ensure consistent height */
        }

        td:before {
            content: attr(data-label);
            position: absolute;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            text-align: left;
            font-weight: bold;
            color: #245580;
        }

        .btn-custom {
            display: block;
            width: 100%;
            margin-top: 0.5rem;
            text-align: center;
        }
    }
</style>

<style>
        .dash-content {
            padding: 20px;
        }

        .overview {
            background-color: #f0f4f8;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .title {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .title i {
            font-size: 24px;
            margin-right: 10px;
            color: #4e73df;
        }

        .title .text {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
/* Ensure the top 3 teachers box doesn't overlap with the sidebar */
.d-flex.justify-content-center {
    margin-left: auto;
    margin-right: auto;
    max-width: 200%; /* Adjust this value if you need more space */
}

/* Prevent content from overflowing the page */
.container-fluid {
    max-width: 200%; /* Adjust this value if you need more space */

    padding-top: 5%;
    padding-left: 15px;
    padding-right: 15px;
}

        .card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error-message {
            background-color: #ffe5e5;
            color: #d63031;
            border: 1px solid #fab1a0;
        }

        .success-message {
            background-color: #e5ffe5;
            color: #27ae60;
            border: 1px solid #a3e9a4;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #4a5568;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4e73df;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #718096;
        }

        .btn-primary {
            background-color: #4e73df;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s ease;
            width: 60%;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }

        @media (max-width: 768px) {
            .dash-content {
                padding: 10px;
            }

            .overview {
                padding: 15px;
            }

            .card {
                padding: 20px;
            }
        }

        .rating-section {
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
            margin: 20px;
        }

        .rating-section h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .btn-custom {
            font-style: normal;
            text-align: center;
            /* Center-align text horizontally */
            padding: 4px 8px;
            /* Padding for button size */
            width: auto;
            /* Fit button to text width */
            font-family: Arial, sans-serif;
            background-color: #245580;
            font-size: 12px;
            /* Small font size */
            color: #ffffff;
            /* Text color for visibility */
            border: none;
            /* Remove default border */
            border-radius: 4px;
            /* Rounded corners */
            display: block;
            /* Inline element */
            cursor: pointer;
            /* Pointer cursor on hover */
            text-decoration: none;
            /* Remove text underline */
            line-height: normal;
            /* Normal line height */
            height: auto;
            /* Auto height to fit content */
            white-space: nowrap;
            /* Prevent text wrapping */

        }
    </style>

    <script src="script.js"></script>
</body>
<style>
    /* ===== Google Font Import - Poppins ===== */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    :root {
        /* ===== Colors ===== */
        --primary-color: #0E4BF1;
        --panel-color: #FFF;
        --text-color: #000;
        --black-light-color: #707070;
        --border-color: #e6e5e5;
        --toggle-color: #DDD;
        --box1-color: #4DA3FF;
        --box2-color: #FFE6AC;
        --box3-color: #E7D1FC;
        --title-icon-color: #fff;
        --dark-bluee: #000080;
        --dark-blue: #245580;
        --dark-yellow: #B8860B;

        /* ====== Transition ====== */
        --tran-05: all 0.5s ease;
        --tran-03: all 0.3s ease;
        --tran-03: all 0.2s ease;
    }

    body {
        min-height: 100vh;
        background-color: var(--primary-color);
    }

    body.dark {
        --primary-color: #3A3B3C;
        --panel-color: #242526;
        --text-color: #CCC;
        --black-light-color: #CCC;
        --border-color: #4D4C4C;
        --toggle-color: #FFF;
        --box1-color: #3A3B3C;
        --box2-color: #3A3B3C;
        --box3-color: #3A3B3C;
        --title-icon-color: #CCC;
    }

    /* === Custom Scroll Bar CSS === */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #0b3cc1;
    }

    body.dark::-webkit-scrollbar-thumb:hover,
    body.dark .activity-data::-webkit-scrollbar-thumb:hover {
        background: #3A3B3C;
    }

    nav {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        padding: 10px 14px;
        background-color: var(--panel-color);
        border-right: 1px solid var(--border-color);
        transition: var(--tran-05);
    }

    nav.close {
        width: 73px;
    }

    nav .logo-name {
        display: flex;
        align-items: center;
    }

    nav .logo-image {
        display: flex;
        justify-content: center;
        min-width: 55px;
    }

    nav .logo-image img {
        width: 55px;
        object-fit: cover;
        border-radius: 50%;
    }

    nav .logo-name .logo_name {
        font-size: 22px;
        font-weight: 600;
        color: var(--text-color);
        margin-left: 14px;
        transition: var(--tran-05);
    }

    nav.close .logo_name {
        opacity: 0;
        pointer-events: none;
    }

    nav .menu-items {
        margin-top: 40px;
        height: calc(100% - 90px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .menu-items li {
        list-style: none;
    }

    .menu-items li a {
        display: flex;
        align-items: center;
        height: 50px;
        text-decoration: none;
        position: relative;
    }

    .nav-links li a:hover:before {
        content: "";
        position: absolute;
        left: -7px;
        height: 5px;
        width: 5px;
        border-radius: 50%;
        background-color: var(--primary-color);
    }

    body.dark li a:hover:before {
        background-color: var(--text-color);
    }

    .menu-items li a i {
        font-size: 24px;
        min-width: 45px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--black-light-color);
    }

    .menu-items li a .link-name {
        font-size: 18px;
        font-weight: 400;
        color: var(--black-light-color);
        transition: var(--tran-05);
    }

    nav.close li a .link-name {
        opacity: 0;
        pointer-events: none;
    }

    .nav-links li a:hover i,
    .nav-links li a:hover .link-name {
        color: var(--primary-color);
    }

    body.dark .nav-links li a:hover i,
    body.dark .nav-links li a:hover .link-name {
        color: var(--text-color);
    }

    .menu-items .logout-mode {
        padding-top: 10px;
        border-top: 1px solid var(--border-color);
    }

    .menu-items .mode {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .menu-items .mode-toggle {
        position: absolute;
        right: 14px;
        height: 50px;
        min-width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .mode-toggle .switch {
        position: relative;
        display: inline-block;
        height: 22px;
        width: 40px;
        border-radius: 25px;
        background-color: var(--toggle-color);
    }

    .switch:before {
        content: "";
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        height: 15px;
        width: 15px;
        background-color: var(--panel-color);
        border-radius: 50%;
        transition: var(--tran-03);
    }

    body.dark .switch:before {
        left: 20px;
    }

    .dashboard {

        position: relative;
        left: 250px;
        background-image: url(img/background1.jpg);
        min-height: 100vh;
        width: calc(100% - 250px);
        padding: 10px 14px;
        transition: var(--tran-05);
    }

    nav.close~.dashboard {
        left: 73px;
        width: calc(100% - 73px);
    }

    .dashboard .top {
        position: fixed;
        top: 0;
        left: 250px;
        display: flex;
        width: calc(100% - 250px);
        justify-content: space-between;
        align-items: center;
        padding: 10px 14px;
        background-color: var(--panel-color);
        transition: var(--tran-05);
        z-index: 10;
    }

    nav.close~.dashboard .top {
        left: 73px;
        width: calc(100% - 73px);
    }

    .dashboard .top .sidebar-toggle {
        font-size: 26px;
        color: var(--text-color);
        cursor: pointer;
    }

    .dashboard .top .search-box {
        position: relative;
        height: 45px;
        max-width: 600px;
        width: 100%;
        margin: 0 30px;
    }

    .top .search-box input {
        position: absolute;
        border: 1px solid var(--border-color);
        background-color: var(--panel-color);
        padding: 0 25px 0 50px;
        border-radius: 5px;
        height: 100%;
        width: 100%;
        color: var(--text-color);
        font-size: 15px;
        font-weight: 400;
        outline: none;
    }

    .top .search-box i {
        position: absolute;
        left: 15px;
        font-size: 22px;
        z-index: 10;
        top: 50%;
        transform: translateY(-50%);
        color: var(--black-light-color);
    }

    .top img {
        width: 40px;
        border-radius: 50%;
    }

    .dashboard .dash-content {
        padding-top: 50px;
    }

    .dash-content .title {
        display: flex;
        margin-top: 5%;

    }

    .dash-content .title i {
        position: relative;
        height: 35px;
        width: 35px;
        background-color: var(--primary-color);
        border-radius: 6px;
        color: var(--title-icon-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .dash-content .title .text {
        font-size: 24px;
        font-weight: 500;
        color: var(--text-color);
        margin-left: 10px;
    }

    .dash-content .boxes {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .dash-content .boxes .box {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 12px;
        width: calc(100% / 3 - 15px);
        padding: 15px 20px;
        background-color: var(--box1-color);
        transition: var(--tran-05);
    }

    .boxes .box i {
        font-size: 35px;
        color: var(--text-color);
    }

    .boxes .box .text {
        white-space: nowrap;
        font-size: 18px;
        font-weight: 500;
        color: var(--text-color);
    }

    .boxes .box .number {
        font-size: 40px;
        font-weight: 500;
        color: var(--text-color);
    }

    .boxes .box.box2 {
        background-color: var(--box2-color);
    }

    .boxes .box.box3 {
        background-color: var(--box3-color);
    }

    .dash-content .activity .activity-data {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .activity .activity-data {
        display: flex;
    }

    .activity-data .data {
        display: flex;
        flex-direction: column;
        margin: 0 15px;
    }

    .activity-data .data-title {
        font-size: 20px;
        font-weight: 500;
        color: var(--text-color);
    }

    .activity-data .data .data-list {
        font-size: 18px;
        font-weight: 400;
        margin-top: 20px;
        white-space: nowrap;
        color: var(--text-color);
    }

    @media (max-width: 1000px) {
        nav {
            width: 73px;
        }

        nav.close {
            width: 250px;
        }

        nav .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close .logo_name {
            opacity: 1;
            pointer-events: auto;
        }

        nav li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close li a .link-name {
            opacity: 1;
            pointer-events: auto;
        }

        nav~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        nav.close~.dashboard {
            left: 250px;
            width: calc(100% - 250px);
        }

        nav~.dashboard .top {
            left: 73px;
            width: calc(100% - 73px);
        }

        nav.close~.dashboard .top {
            left: 250px;
            width: calc(100% - 250px);
        }

        .activity .activity-data {
            overflow-X: scroll;
        }
    }

    @media (max-width: 780px) {
        .dash-content .boxes .box {
            width: calc(100% / 2 - 15px);
            margin-top: 15px;
        }
    }

    @media (max-width: 560px) {
        .dash-content .boxes .box {
            width: 100%;
        }
    }

    @media (max-width: 470px) {
        nav {
            width: 0px;
        }

        nav.close {
            width: 73px;
        }

        nav .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close .logo_name {
            opacity: 0;
            pointer-events: none;
        }

        nav li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        nav.close li a .link-name {
            opacity: 0;
            pointer-events: none;
        }

        nav~.dashboard {
            left: 0;
            width: 100%;
        }

        nav.close~.dashboard {
            left: 73px;
            width: calc(100% - 73px);
        }

        nav~.dashboard .top {
            left: 0;
            width: 100%;
        }

        nav.close~.dashboard .top {
            left: 0;
            width: 100%;
        }
    }
    .btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.1s;
}

    


.btn-primary:active {
    transform: scale(0.98);
}

@media (max-width: 480px) {
    .btn {
        width: 100%;
        padding: 12px;
    }
}
    .btn-subject {
        font-style: normal;
        text-align: center;
        /* Center-align text horizontally */
        padding: 4px 8px;
        /* Padding for button size */
        width: auto;
        /* Fit button to text width */
        font-family: Arial, sans-serif;
        background-color: #245580;
        font-size: 12px;
        /* Small font size */
        color: white;
        /* Text color for visibility */
        border: none;
        /* Remove default border */
        border-radius: 4px;
        /* Rounded corners */
        display: inline-block;
        /* Inline element */
        cursor: pointer;
        /* Pointer cursor on hover */
        text-decoration: none;
        /* Remove text underline */
        line-height: normal;
        /* Normal line height */
        height: auto;
        /* Auto height to fit content */

        /* Align text vertically */
        white-space: nowrap;
        /* Prevent text wrapping */
        display: block;
    }



    /* Optional: Additional hover effect for better UX */
    .btn-subject:hover {
        background-color: #1b4264;
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
        padding: 15px 10px;
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
        color: white;
        display: inline-block;
        text-decoration: none;
        outline: none !important;
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



    .container {
        margin-top: 10%;
        max-width: 800px;
        width: 100%;
        background-color: #fff;
        padding: 25px 30px;

        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        border: 3px solid;
        /* Set the border width */
        border-image: linear-gradient(100deg, var(--dark-blue), var(--dark-yellow)) 1;
        /* Add some padding to see the effect */
        /* Center the text inside the div */

    }

    .container .title {
        font-size: 25px;
        font-weight: 500;
        position: relative;
    }

    .container .title::before {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        border-radius: 5px;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    .content form .user-details {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 20px 0 12px 0;
    }

    form .user-details .input-box {
        margin-bottom: 15px;
        width: calc(100% / 2 - 20px);
    }

    form .input-box span.details {
        display: block;
        font-weight: 500;
        margin-bottom: 5px;
    }

    .user-details .input-box input {
        height: 45px;
        width: 100%;
        outline: none;
        font-size: 16px;
        border-radius: 5px;
        padding-left: 15px;
        border: 1px solid #ccc;
        border-bottom-width: 2px;
        transition: all 0.3s ease;
    }

    .user-details .input-box input:focus,
    .user-details .input-box input:valid {
        border-color: #B8860B;
    }

    form .button {
        height: 45px;
        margin: 35px 0
    }

    form .button input {
        height: 100%;
        width: 100%;
        border-radius: 5px;
        border: none;
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #71b7e6, #9b59b6);
    }

    form .button input:hover {
        background: linear-gradient(-135deg, #71b7e6, #9b59b6);
    }

    @media(max-width: 400px) {



        .container {
            margin-top: 25%;
            width: 120%;

        }

        .btn-subject {
            text-align: left;
            padding: 10px 10px;
            width: auto;
            height: auto;
            font-family: Arial, sans-serif;
            background-color: #245580;
            font-size: 12px;
            color: white;
            border: none;
            border-radius: 5px;
            display: inline-block;
            cursor: pointer;
            text-decoration: none;
            line-height: normal;
            white-space: nowrap;
        }


        form .user-details .input-box {
            margin-bottom: 15px;
            width: 100%;
        }

        .content form .user-details {
            max-height: 300px;
            overflow-y: scroll;
            background-image: url(img/test.jpg);
        }

        .user-details::-webkit-scrollbar {
            width: 5px;
        }
    }

    @media(max-width: 459px) {
        .navbar {

            display: none;
        }


        .container .content .category {
            flex-direction: column;
        }
    }

    .progressbar {
        position: relative;
        display: flex;
        justify-content: space-between;
        counter-reset: step;
        margin: 2rem 0 4rem;
    }

    .progressbar::before,
    .progress {
        content: "";
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        background-color: #dcdcdc;
        z-index: 1;
    }

    .progress {
        background-color: #B8860B;
        width: 0%;
        transition: 0.3s;
    }

    .progress-step {
        width: 2.1875rem;
        height: 2.1875rem;
        background-color: #dcdcdc;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .progress-step::before {
        counter-increment: step;
        content: counter(step);
    }

    .progress-step::after {
        content: attr(data-title);
        position: absolute;
        top: calc(100% + 0.5rem);
        font-size: 0.85rem;
        color: #666;
    }

    .progress-step-active {
        background-color: #245580;
        color: #f3f3f3;
    }

    .step-forms {
        display: none;
    }

    .step-forms-active {
        display: block;
    }

    .btns-group {
        display: flex;
        justify-content: space-between;
    }

    .btn {
        padding: 0.75rem;
        text-decoration: none;
        background-color: #245580;
        color: #fff;
        text-align: center;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: 0.3s;
    }



    .input-box {
        position: relative;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        width: max-content;
        /* Adjust width */
        overflow-y: auto;
        max-height: 150px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .gradient-border {
        border: 5px solid;
        /* Set the border width */
        border-image: linear-gradient(100deg, var(--dark-blue), var(--dark-yellow)) 1;
        padding: 20px;
        /* Add some padding to see the effect */
        text-align: center;
        /* Center the text inside the div */
    }

    
</style>

<script>
    function togglePassword(inputId) {
        var input = document.getElementById(inputId);
        var icon = input.nextElementSibling;

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("uil-eye-slash");
            icon.classList.add("uil-eye");
        } else {
            input.type = "password";
            icon.classList.remove("uil-eye");
            icon.classList.add("uil-eye-slash");
           
        }
    }
</script>

<script>
    const body = document.querySelector("body"),
        modeToggle = body.querySelector(".mode-toggle");
    sidebar = body.querySelector("nav");
    sidebarToggle = body.querySelector(".sidebar-toggle");
    let getMode = localStorage.getItem("mode");
    if (getMode && getMode === "dark") {
        body.classList.toggle("dark");
    }
    let getStatus = localStorage.getItem("status");
    if (getStatus && getStatus === "close") {
        sidebar.classList.toggle("close");
    }
    modeToggle.addEventListener("click", () => {
        body.classList.toggle("dark");
        if (body.classList.contains("dark")) {
            localStorage.setItem("mode", "dark");
        } else {
            localStorage.setItem("mode", "light");
        }
    });
    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        if (sidebar.classList.contains("close")) {
            localStorage.setItem("status", "close");
        } else {
            localStorage.setItem("status", "open");
        }
    })
</script>


</html>