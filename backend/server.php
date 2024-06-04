<?php
session_start();
require('Captcha-System/CaptchaGenerator.php');
require('Captcha-System/ImageGenerator.php');
require('DB-System/quiryBuilder.php');
require('DB-System/quiryBuilderConnector.php');
require('Authentication-System/loginHandler.php');
require('Authentication-System/registeration-server.php');
require('Mailer/mailer.php');
require('Mailer/Verification-code/codeGenerator.php');

use database\DB;
use database\DBConnection;
use Auth\Login;
use Auth\Register;
use Mail\Mailer;


DB::setConnection(new DBConnection);


if (isset($_POST['login'])) {
    return Login::identify($_POST) ? header('Location:../Authenticated.html') : header('Location:../Unauthenticated.html');
}
if (isset($_POST['resend'])) {
    $msg = "
    <h4 class='text-white text-3xl'>Your Verification Code is :</h4><br>
    <input class='text-white  p-2 m-auto' style='padding:5px;font-size:x-large;' readonly value={$_SESSION['code']}>
    ";
    Mailer::send('Verification Code', $msg);
    header('Location:../Email-Verification.php');
}
if (isset($_POST['verify-code'], $_POST['code'])) {
    Register::verify($_POST['code'], $_SESSION['code']);
}
// registeration handler
$requests = trim(file_get_contents("php://input"));
$received_data = json_decode($requests, true);
if ($received_data) {
    Register::check($received_data);
    Register::save_sendMail();
}
