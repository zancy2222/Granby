<?php
include('dbcon.php');
session_start();

if (!isset($_SESSION['id_student'])) {
    header('Location: Slogin.php');
    exit();
}

$id_student = $_SESSION['id_student'];

// Fetch user data from the database
$query = "SELECT * FROM slogin WHERE id_student = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $id_student);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    $_SESSION['status'] = "User data not found!";
    header('Location: Slogin.php');
    exit();
}
?>



<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="img/logobg.png">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Student Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        @media screen and (max-width: 600px) {

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
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                content: attr(data-label);
                position: absolute;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                font-weight: bold;
            }
        }

        .profile-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-field {
            flex: 1 1 calc(50% - 20px);
            min-width: 200px;
        }

        .profile-field label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .profile-field input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fff;
            transition: border-color 0.3s ease;
        }

        .profile-field input:focus {
            outline: none;
            border-color: #4e73df;
        }

        .profile-field input[readonly] {
            background-color: #f0f0f0;
            cursor: default;
        }

        @media (max-width: 768px) {
            .profile-field {
                flex: 1 1 100%;
            }
        }
    </style>

</head>

<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="img/logobg.png" alt="">
            </div>
            <span class="logo_name">Profile</span>
        </div>
        <div class="menu-items">
        <ul class="nav-links">
                <li><a href="Topteacher.php"><i class="uil uil-chart"></i><span class="link-name">Dashboard</span></a></li>
                <li><a href="test.php"><i class="uil uil-estate"></i><span class="link-name">Evaluation</span></a></li>
                <li><a href="StudentProfile.php"><i class="uil uil-files-landscapes"></i><span class="link-name">Profile</span></a></li>
                <li><a href="Schangepass.php"><i class="uil uil-chart"></i><span class="link-name">Change password</span></a></li>
            </ul>

            <ul class="logout-mode">
                <li><a href="logout.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <style>
    .custom-select {
        position: relative;
        font-family: Arial, sans-serif;
        font-size: 14px;
        color: #333;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 6px 30px 6px 12px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 8px center;
        background-size: 18px;
        cursor: pointer;
    }

    .custom-select:focus {
        outline: none;
        border-color: #66afe9;
        box-shadow: 0 0 8px rgba(102, 175, 233, 0.6);
    }
</style>

<style>
    body.dark {
    --primary-color: #3A3B3C;
    --panel-color: #242526;
    --text-color: #fff;
    --black-light-color: #CCC;
    --border-color: #4D4C4C;
    --toggle-color: #FFF;
    --box1-color: #3A3B3C;
    --box2-color: #3A3B3C;
    --box3-color: #3A3B3C;
    --title-icon-color: white;
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

body.dark {
    background-color: var(--panel-color);
    color: var(--text-color);
}

body.dark .dashboard {
    background-color: var(--panel-color);
}

body.dark .profile-container {
    background-color: var(--box1-color);
}

body.dark .custom-select {
    background-color: var(--box1-color);
    border-color: var(--border-color);
    color: var(--text-color);
}

body.dark .btn {
    background-color: var(--primary-color);
    color: var(--toggle-color);
}

body.dark label {
    color: var(--text-color);
}

body.dark input[type="text"] {
    background-color: var(--box1-color);
    color: var(--text-color);
    border-color: var(--border-color);
}

body.dark .overview .text {

    color: darkblue;
}

</style>
<section class="dashboard">
    <div class="top">
        <i class="uil uil-bars sidebar-toggle"></i>
        <img src="images/profile.jpg" alt="">
    </div>

    <div class="dash-content">
        <div class="overview">
            <div class="title">
                <i class="uil uil-user-circle"></i>
                <span class="text">Personal details</span>
            </div>

            <form method="post" action="update_profile.php">
                <div class="profile-container">
                    <div class="profile-field">
                        <label for="id_student">Student ID</label>
                        <input type="text" id="id_student" name="id_student" value="<?php echo htmlspecialchars($user_data['id_student']); ?>" readonly>
                    </div>
                    <div class="profile-field">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($user_data['Fname']); ?>">
                    </div>
                    <div class="profile-field">
                        <label for="mname">Middle Name</label>
                        <input type="text" id="mname" name="mname" value="<?php echo htmlspecialchars($user_data['Mname']); ?>">
                    </div>
                    <div class="profile-field">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($user_data['Lname']); ?>">
                    </div>
                    <div class="profile-field">
                        <label for="suffix">Suffix</label>
                        <input type="text" id="suffix" name="suffix" value="<?php echo htmlspecialchars($user_data['Suffix']); ?>">
                    </div>
                    <div class="profile-field">
                        <label for="branch">Branch</label>
                        <select id="branch" name="branch" class="custom-select w-40">
                            <option value="<?php echo htmlspecialchars($user_data['Branch']); ?>" selected><?php echo htmlspecialchars($user_data['Branch']); ?></option>
                            <?php
                            $selectedBranch = isset($_GET['branch']) ? $_GET['branch'] : '';
                            $branchesCourses = [
                                'Granby College' => [
                                    'Bachelor of Science in Elementary Education',
                                    'Bachelor of Science in Secondary Education - English',
                                    'Bachelor of Science in Information Technology',
                                    'Bachelor of Science in Computer Science',
                                    'Bachelor of Science in Tourism Management',
                                    'Bachelor of Science in Criminology'
                                ],
                                // Add more branches here
                            ];
                            foreach ($branchesCourses as $branch => $courses) {
                                echo "<option value=\"$branch\">" . htmlspecialchars($branch) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="profile-field">
                        <label for="course">Course</label>
                        <select id="course" name="course" class="custom-select w-40">
                            <option value="<?php echo htmlspecialchars($user_data['Course']); ?>" selected><?php echo htmlspecialchars($user_data['Course']); ?></option>
                            <?php
                            $branchesCoursesSection = [
                                'Granby College' => [
                                    'Bachelor of Science in Elementary Education',
                                    'Bachelor of Science in Secondary Education - English',
                                    'Bachelor of Science in Information Technology',
                                    'Bachelor of Science in Computer Science',
                                    'Bachelor of Science in Tourism Management',
                                    'Bachelor of Science in Criminology'
                                ],
                                // Add more courses here
                            ];
                            foreach ($branchesCourses[$user_data['Branch']] as $course) {
                                echo "<option value=\"$course\">" . htmlspecialchars($course) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="profile-field">
                        <label for="section">Section</label>
                        <select id="section" name="section" class="custom-select w-40">
                            <option value="<?php echo htmlspecialchars($user_data['Section']); ?>" selected><?php echo htmlspecialchars($user_data['Section']); ?></option>
                            <?php
                            $branchesCoursesSection = [
                                'Granby College' => [
                                    'BEED 1A', 'BEED 1B', 'BEED 1C',
                                    'BSED 1A', 'BSED 1B', 'BSED 1C',
                                    'BSIT 1A', 'BSIT 1B', 'BSIT 1C', 'BSIT 1D', 'BSIT 1E', 'BSIT 1F',
                                    'BSIT 2A', 'BSIT 2B', 'BSIT 2C', 'BSIT 2D',
                                    'BSIT 3A', 'BSIT 3B', 'BSIT 3C',
                                    'BSIT 4A', 'BSIT 4B',
                                    'BCS 1A', 'BCS 1B', 'BCS 1C',
                                    'BSCS 2', 'BSCS 3', 'BSCS 4',
                                    'BTM 1A', 'BTM 1B', 'BTM 1C',
                                    'BCRIM 1A', 'BCRIM 1B', 'BCRIM 1C',
                                ],
                                // Add more sections here
                            ];
                            foreach ($branchesCoursesSection[$user_data['Branch']] as $section) {
                                echo "<option value=\"$section\">" . htmlspecialchars($section) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>
</section>

    <style>
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
        padding: 10px ;
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