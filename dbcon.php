<?php
ob_start();

include('db.php');






if (isset($_POST['mlogin'])) {
    $username = mysqli_real_escape_string($con, $_POST['m_username']);
    $password = mysqli_real_escape_string($con, $_POST['pass']);

    $query = "SELECT * FROM m_login WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['m_username'] = $user['username']; // Set session variable for username
        header('Location: Teacher.php'); // Redirect to the dashboard on successful login
        exit();
    } else {
        $_SESSION['status'] = "Invalid username or password!";
        header('Location: 404.html'); // Redirect to error page
        exit();
    }
}



if (isset($_POST['login'])) {
    // Sanitize user inputs to prevent SQL injection
    $id_student = mysqli_real_escape_string($con, $_POST['id_student']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);

    // Check if the input fields are not empty
    if (empty($id_student) || empty($pass)) {
        $_SESSION['status'] = "Please fill in all the fields!";
    } else {
        // Query the database to check if the student ID and password match
        $query = "SELECT * FROM slogin WHERE id_student='$id_student' AND pass='$pass'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // User found, fetch data and set session variables
            $user = mysqli_fetch_assoc($result);
            $_SESSION['id_student'] = $user['id_student'];  // Set session variable for student ID
            $_SESSION['section'] = $user['Section'];  // Store section in session

            // Redirect to the dashboard on successful login
            header('Location: Topteacher.php');
            exit();
        } else {
            // If no user matches, set error message
            $_SESSION['status'] = "Invalid ID or password!";
        }
    }
}


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


    // Add more branches and corresponding courses here
];


$branchesCoursesSection = [
    'Granby College' => [
        'BEED 1A',
        'BEED 1B',
        'BEED 1C',
        'BSED 1A',
        'BSED 1B',
        'BSED 1C',
        'BSIT 1A',
        'BSIT 1B',
        'BSIT 1C',
        'BSIT 1D',
        'BSIT 1E',
        'BSIT 1F',
        'BSIT 2A',
        'BSIT 2B',
        'BSIT 2C',
        'BSIT 2D',
        'BSIT 3A',
        'BSIT 3B',
        'BSIT 3C',
        'BSIT 4A',
        'BSIT 4B',
        'BCS 1A',
        'BCS 1B',
        'BCS 1C',
        'BSCS 2',
        'BSCS 3',
        'BSCS 4',
        'BTM 1A',
        'BTM 1B',
        'BTM 1C',
        'BCRIM 1A',
        'BCRIM 1B',
        'BCRIM 1C',

    ],


];


if (isset($_POST['save_changes'])) {
    $id_student = mysqli_real_escape_string($con, $_POST['id_student']);
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $Cpass = mysqli_real_escape_string($con, $_POST['Cpass']);
    $Fname = mysqli_real_escape_string($con, $_POST['Fname']);
    $Mname = mysqli_real_escape_string($con, $_POST['Mname']);
    $Lname = mysqli_real_escape_string($con, $_POST['Lname']);
    $Suffix = mysqli_real_escape_string($con, $_POST['Suffix']);
    $Branch = mysqli_real_escape_string($con, $_POST['Branch']);
    $Course = mysqli_real_escape_string($con, $_POST['Course']);
    $Section = mysqli_real_escape_string($con, $_POST['Section']);

    if ($pass != $Cpass) {
        $_SESSION['status'] = "Passwords do not match!";
        header('Location: test.php');
        exit();
    }

    $check_query = "SELECT * FROM slogin WHERE id_student='$id_student'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['status'] = "Student ID already exists!";
        header('Location: registration.php');
        exit();
    }

    $query = "INSERT INTO slogin (id_student, pass, Cpass, Fname, Mname, Lname, Suffix, Branch, Course, Section) VALUES ('$id_student', '$pass', '$Cpass', '$Fname', '$Mname', '$Lname', '$Suffix', '$Branch', '$Course', '$Section')";

    if (mysqli_query($con, $query)) {

        $_SESSION['section'] = $Section; // Store section in session
        header('Location: Slogin.php');
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
        $_SESSION['status'] = "Something went wrong!";
        header('Location: registration.php');
        exit();
    }
}

if (isset($_SESSION['id_student']) && isset($_SESSION['pass'])) {
    // Get the total number of questions
    $query = "SELECT COUNT(*) AS total FROM questions";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $total_questions = $row['total'];

    // Number of questions per page
    $questions_per_page = 10;

    // Calculate the total number of pages
    $total_pages = ceil($total_questions / $questions_per_page);

    // Get the current page number
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    // Calculate the starting index for the current page
    $start_index = ($current_page - 1) * $questions_per_page;

    // Fetch the questions for the current page
    $query = "SELECT * FROM questions LIMIT $start_index, $questions_per_page";
    $result = mysqli_query($con, $query);
    $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

if (isset($_POST['save_evaluation'])) {
    $user_id = mysqli_real_escape_string($con, $_POST['user_id']);
    $teacher_id = mysqli_real_escape_string($con, $_POST['teacher_id']);
    $Tname = mysqli_real_escape_string($con, $_POST['Tname']);
    $Tsubject = mysqli_real_escape_string($con, $_POST['Tsubject']);
    $teacher_feedback = mysqli_real_escape_string($con, $_POST['teacher_feedback']); // Get the teacher feedback
    $Q1 = mysqli_real_escape_string($con, $_POST['Q1']);
    $Q2 = mysqli_real_escape_string($con, $_POST['Q2']);
    $Q3 = mysqli_real_escape_string($con, $_POST['Q3']);
    $Q4 = mysqli_real_escape_string($con, $_POST['Q4']);
    $Q5 = mysqli_real_escape_string($con, $_POST['Q5']);
    $Q6 = mysqli_real_escape_string($con, $_POST['Q6']);
    $Q7 = mysqli_real_escape_string($con, $_POST['Q7']);
    $Q8 = mysqli_real_escape_string($con, $_POST['Q8']);
    $Q9 = mysqli_real_escape_string($con, $_POST['Q9']);

    // Insert evaluation data into the database including the teacher feedback
    $query = "INSERT INTO evaluation_form (user_id, teacher_id, Tname, Tsubject, teacher_feedback, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, evaluation_time) 
              VALUES ('$user_id', '$teacher_id', '$Tname', '$Tsubject', '$teacher_feedback', '$Q1', '$Q2', '$Q3', '$Q4', '$Q5', '$Q6', '$Q7', '$Q8', '$Q9', NOW())";

    if (mysqli_query($con, $query)) {
        header('Location: test.php');
        exit();
    } else {
        $_SESSION['status'] = "Something went wrong while saving the evaluation!";
        header('Location: evaluation.php');
        exit();
    }
}



error_reporting(0);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['save_teacher'])) {
    $Tname = mysqli_real_escape_string($con, $_POST['Tname']);
    $Tsubject = mysqli_real_escape_string($con, $_POST['Tsubject']);
    $Branch = mysqli_real_escape_string($con, $_POST['Branch']);
    $Section = mysqli_real_escape_string($con, $_POST['Section']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "./teacher/" . $filename;

    // Check if directory exists, if not create it
    if (!is_dir("./teacher/")) {
        mkdir("./teacher/", 0777, true);
    }

    // Move the uploaded image into the folder
    if (move_uploaded_file($tempname, $folder)) {
        // Insert form data and image path into the database
        $sql = "INSERT INTO teacher (Tname, Tsubject, Branch, Section, image_path, password) VALUES ('$Tname', '$Tsubject', '$Branch', '$Section', '$folder', '$hashed_password')";
        $query_run = mysqli_query($con, $sql);

        if ($query_run) {
            $msg = "Image uploaded and teacher added successfully!";
        } else {
            $msg = "Failed to add teacher!";
        }
    } else {
        $msg = "Failed to upload image!";
    }

    // Redirect or display confirmation
    header('Location: Teacher.php');
    exit();
}




// Handle student info update
if (isset($_POST['edit_changes'])) {
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $fullname = mysqli_real_escape_string($con, $_POST['fullname']);
    $emails = mysqli_real_escape_string($con, $_POST['emails']);
    $Phonenum = mysqli_real_escape_string($con, $_POST['Phonenum']);
    $Section = mysqli_real_escape_string($con, $_POST['Section']);
    $age = mysqli_real_escape_string($con, $_POST['age']);

    $query = "UPDATE regform SET fullname='$fullname', emails='$emails', Phonenum='$Phonenum', Section='$Section', age='$age' WHERE id=$student_id";

    if (mysqli_query($con, $query)) {
        // Success message modal
        echo "<script>
                $(document).ready(function(){
                    $('#successModal').modal('show');
                });
              </script>";
    } else {
        // Error message modal
        echo "<script>
                $(document).ready(function(){
                    $('#errorModal').modal('show');
                });
              </script>";
    }
}
if (isset($_POST['delete_student'])) {
    $id_student = $_POST['id_student'];
    $query = "DELETE FROM slogin WHERE id_student = '$id_student' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo '<script>alert("Data deleted")</script>';
        header("Location: index.php");
        exit();
    } else {
        echo '<script>alert("Data deletion failed")</script>';
        header("Location: Teacher.php");
        exit();
    }
}

if (isset($_POST['delete_question'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM questions WHERE id = '$id' ";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo '<script>alert("Data deleted")</script>';
        header("Location: question.php");
        exit();
    } else {
        echo '<script>alert("Data deletion failed")</script>';
        header("Location: Teacher.php");
        exit();
    }
}


if (isset($_POST['save_question'])) {
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $question_text = mysqli_real_escape_string($con, $_POST['question_text']);
    $rate = mysqli_real_escape_string($con, $_POST['rate']);

    $query = "INSERT INTO questions (id, question_text, rate) VALUES ('$id', '$question_text', '$rate')";

    if (mysqli_query($con, $query)) {
        header('Location: question.php');
        exit();
    } else {
        $_SESSION['status'] = "Something went wrong while saving the question!";
        header('Location: evaluation.php');
        exit();
    }
}


if (isset($_POST['save_subject'])) {
    $Tsubject = mysqli_real_escape_string($con, $_POST['Tsubject']);
    $query = "INSERT INTO teacher (Tsubject) VALUES ('$Tsubject')";
    if (mysqli_query($con, $query)) {
        header('Location: managesubject.php');
        exit();
    } else {
        $_SESSION['status'] = "Something went wrong while saving the subject!";
        header('Location: managesubject.php');
        exit();
    }
}


if (isset($_POST['update_subject'])) {
    $id = mysqli_real_escape_string($con, $_POST['edit_id']);
    $subject = mysqli_real_escape_string($con, $_POST['edit_subject']);

    $query = "UPDATE teacher SET Tsubject='$subject' WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        https: //cp1.awardspace.net/#
        $_SESSION['message'] = "Subject updated successfully";
    } else {
        $_SESSION['message'] = "Subject update failed";
    }
    header('Location: managesubject.php');
    exit();
}

if (isset($_POST['delete_subject'])) {
    $id = mysqli_real_escape_string($con, $_POST['delete_id']);

    $query = "DELETE FROM teacher WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        $_SESSION['message'] = "Subject deleted successfully";
    } else {
        $_SESSION['message'] = "Subject deletion failed";
    }
    header('Location: managesubject.php');
    exit();
}
ob_end_flush();
