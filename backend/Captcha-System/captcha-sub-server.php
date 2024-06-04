<?php
session_start();
require 'CaptchaGenerator.php';
require 'ImageGenerator.php';

use captcha\CaptchaGenerator as captcha ;
use captcha\ImageGenerator as img ;

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $_SESSION['captcha'] = captcha::getCaptcha() ;
    img::generate($_SESSION['captcha']);
    $test = ['path'=>img::$returnedPath] ;
    exit(json_encode($test));
}
else{
    $test = ['error'=>'something went wrong'] ;
    exit(json_encode($test));
}
