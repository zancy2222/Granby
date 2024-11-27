<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendemail_verify($name,$email,$verify_token){
    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = "smtp.example.com";                     //Set the SMTP server to send through
    $mail->Username   = "marvinjaytead0@gmail.com";                     //SMTP username
    $mail->Password   = "teadpogi";                               //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("marvinjaytead0@gmail.com",$name);
    $mail->addAddress($email);     //Add a recipient
  

    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Verification for Te-adDev';

    $email_template = "
    <h2>You have Registered With Te-adDev.</h2>
    <h5>Verify your email address to login with the given link below </h5>
    <br/><br/>
    <a href='http://localhost/system/admin/verify-email.php?token=$verify_token'>Click me</a>

    ";

    $mail->Body    = $email_template;
    $mail->send();
    echo 'Message has been sent';
}


if(isset($_POST['register_btn'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token = md5(rand());
    
    sendemail_verify("$name","$email","$verify_token");
    echo "sent email";
    //$check_email_query = "SELECT email FROM admin_panel WHERE email='$email' LIMIT 1";
    //$check_email_query_run = mysqli_query($con, $check_email_query);

    //if(mysqli_num_rows($check_email_query_run) > 0)
    //{
        
        //$_SESSION['status'] = "Email already Exist";
        //header("#sign-up-form");
    //}else{

       // $query = "INSERT INTO users (name,email,password,verify_token) VALUES ('$name','$email','$password','$verify_token')";
        //$query_run = mysqli_query($con, $query);


       // if($query_run)
        //{   
           // sendemail_verify("$name","$email","$verify_token");
           // $_SESSION['status'] = "Registration Success!! Please Verify your email address";
            //header("#sign-up-form");
        //}
        //else{
           // $_SESSION['status'] = "Registration failed";
            //header("#sign-up-form");
        //}
   // }
    
} 
?>