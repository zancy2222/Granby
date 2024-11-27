<?php
session_start();
include('dbcon.php');

if (isset($_POST['mlogin'])) {
    $username = mysqli_real_escape_string($con, $_POST['m_username']);
    $password = $_POST['pass']; // Don't escape the password before verification

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM m_login WHERE username = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($user = mysqli_fetch_assoc($result)) {
        // Verify the password (assuming passwords are hashed in the database)
        if (password_verify($password, $user['password'])) {
            $_SESSION['m_username'] = $user['username'];
            header('Location: Teacher.php');
            exit();
        }
    }

    $_SESSION['status'] = "Invalid username or password!";
    header('Location: mlogin.php'); // Redirect back to login page with error
    exit();
}

// Display the login form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <div class="container">
        <div class="title">Login</div>
        <div class="content">
            <div class="login-container">
                <form action="mlogin.php" method="POST">
                    <div class="step-forms step-forms-active">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Username<span style="color: red;">*</span></span>
                                <input type="text" name="m_username" placeholder="Enter your Username" class="form-control" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Password<span style="color: red;">*</span></span>
                                <input type="password" name="pass" placeholder="Enter your Password" class="form-control" required>
                            </div>
                        </div>
                        <div class="btns-group">
                            <input type="submit" value="Login" name="mlogin" class="btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['status'])) {
        echo "<p style='color: red;'>" . $_SESSION['status'] . "</p>";
        unset($_SESSION['status']);
    }
    ?>
</body>
</html>