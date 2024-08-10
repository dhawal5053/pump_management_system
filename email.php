<?php
session_start();
$email=$_SESSION['email'];
$name=$_SESSION['name'];
// $email=$_POST['email'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = '********@gmail.com';
    $mail->Password   = '*************';
    // gornwddnlkqrklub
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('************@gmail.com', 'VALA INDUSTRIES');
    $mail->addAddress($email,$name);

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from PHPMailer';
    $email_template="
        <h2>Hello</h2>
        <h3>You are receiving this email because we received a password reset request for your account.</h3>
        <br/><br/>
        <a href='http://localhost/Valaindustries/password-change.php?email=$email'>Click Me</a>
        ";
    $mail->Body    = $email_template;

    $mail->send();
    unset($_SESSION['email']);
    echo 'Email sent successfully.';
    header("Location: forgot-password.php");
} catch (Exception $e) {
}
