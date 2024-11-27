<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Management Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="container">
    <div class="title">Management Login</div>
    <div class="content">
        <?php if (isset($_SESSION['status'])): ?>
            <div class="error-message"><?php echo $_SESSION['status']; ?></div>
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>
        
        <form action="management_login.php" method="POST">
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" name="username" placeholder="Enter your Username" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" placeholder="Enter your Password" required>
                </div>
            </div>
            <div class="btns-group">
                <input type="submit" value="Login" name="login" class="btn">
            </div>
        </form>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-image: url(img/background1.jpg);
    }

    .container {
        width: 400px;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .input-box {
        margin-bottom: 15px;
    }

    .details {
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    .input-box input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .btns-group {
        text-align: center;
    }

    .btn {
        padding: 10px 20px;
        background-color: #9b59b6;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn:hover {
        background-color: #8e44ad;
    }

    .error-message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
        font-size: 12px;
    }
</style>
</body>
</html>
