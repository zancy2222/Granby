<?php
session_start();
require_once 'dbcon.php';

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login</title>
  <link rel="stylesheet" href="../assets/css/styles.min.css">

</head>
<body>

<div class="container">
  <div class="title">Login</div>
  <div class="content">
    <div class="login-container">
      <form action="Slogin.php" method="POST">
        <div class="step-forms step-forms-active">

          <!-- Validation message -->
          <?php if (isset($_SESSION['status'])): ?>
            <div class="validation-message">
              <?php echo $_SESSION['status']; unset($_SESSION['status']); ?>
            </div>
          <?php endif; ?>

          <div class="user-details">
            <div class="input-box">
              <span class="details">Student ID<span style="color: red;">*</span></span>
              <input type="text" name="id_student" placeholder="Enter your Student ID" class="form-control" required>
            </div>
            <div class="input-box">
              <span class="details">Password<span style="color: red;">*</span></span>
              <div class="input-group">
                <input type="password" name="pass" placeholder="Enter your Password" id="password" class="form-control" required minlength="8" title="Password must be at least 8 characters long">
                <span class="input-group-text" id="togglePassword">
                  <i class="fa fa-eye"></i>
                </span>
              </div>
              <div id="passwordError" style="color: red; display: none;">Password must be at least 8 characters long.</div>
            </div>
          </div>

          <div class="remember-me">
            <input type="checkbox" name="remember_me" id="remember_me">
            <label for="remember_me">Remember Me</label>
          </div>

          <div class="btns-group">
            <input type="submit" value="Login" name="login" class="btn" id="loginBtn">
          </div>

          <div class="account-link">
            <a href="Sregister.php">Don't have an account?</a>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // Password validation on form submit
  document.getElementById('loginBtn').addEventListener('click', function(e) {
    var password = document.getElementById('password').value;
    if (password.length < 8) {
      e.preventDefault(); // Prevent form submission
      document.getElementById('passwordError').style.display = 'block';
    } else {
      document.getElementById('passwordError').style.display = 'none';
    }
  });
</script>


<!-- Font Awesome Script for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

<!-- JavaScript to toggle password visibility -->
<script>
  const togglePassword = document.getElementById('togglePassword');
  const password = document.getElementById('password');

  togglePassword.addEventListener('click', function () {
    const type = password.type === 'password' ? 'text' : 'password';
    password.type = type;
    this.querySelector('i').classList.toggle('fa-eye');
    this.querySelector('i').classList.toggle('fa-eye-slash');
  });
</script>
  
<style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
   body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
        background-image: url(img/background1.jpg);
    }
    .container {
      width: 100%;
      max-width: 400px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }

    .title {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .validation-message {
      color: red;
      font-weight: bold;
      margin-bottom: 1rem;
      text-align: center;
    }

    .input-box {
      margin-bottom: 1rem;
    }

    .details {
      font-weight: 500;
      color: #555;
      display: inline-block;
      margin-bottom: 0.3rem;
    }

    .form-control {
      width: 100%;
      padding: 0.75rem;
      font-size: 1rem;
      border: 1px solid #ced4da;
      border-radius: 4px;
    }

    .input-group {
      display: flex;
      align-items: center;
    }

    .input-group .form-control {
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
    }

    .input-group-text {
      cursor: pointer;
      padding: 0.5rem;
      border: 1px solid #ced4da;
      border-left: none;
      border-radius: 0 4px 4px 0;
      background-color: #fff;
    }

    .remember-me {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.9rem;
      color: #555;
      margin-bottom: 1rem;
    }

    .btn {
      background: #007bff;
      color: #fff;
      border: none;
      width: 100%;
      padding: 0.75rem;
      font-size: 1rem;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #0056b3;
    }

    .account-link {
      text-align: center;
      font-size: 0.9rem;
      color: #007bff;
      margin-top: 1rem;
    }

    .account-link a {
      color: #007bff;
      text-decoration: none;
      font-weight: 500;
    }

    .account-link a:hover {
      text-decoration: underline;
    }
  </style>
</body>
</html>
