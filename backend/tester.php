<?php
session_start();
require('Captcha-System/CaptchaGenerator.php');
require('Captcha-System/ImageGenerator.php');
require('DB-System/quiryBuilder.php');
require('DB-System/quiryBuilderConnector.php');
// require('Authentication-System/loginHandler.php');
require('Authentication-System/registeration-server.php');
// require('Mailer/Verification-code/codeGenerator.php');
// require('Mailer/mailer.php');

use database\DB;
use database\DBConnection ; 
use captcha\CaptchaGenerator as captcha;
use Auth\Login ;
use Auth\Register;
use captcha\ImageGenerator as img ;


$capthca = captcha::getCaptcha();

$att =['first_name','surname','email','password','birthdate','gender'] ;
$val = ['admin1','admin1','admin1@ex.com','admin1','2022-12-05','0'];
// print_r(DB::select('users'));

DB::setConnection(new DBConnection);

$req = [
    'email' =>'admin@ex.com',
    'password' =>'admin'
];

// $res = Login::identify($req);
// var_dump($res);

$req1 = [
    'firstName' =>'admin1',
    'surname' =>'admin1',
    'email' =>'admin1@ex.com',
    'pass' =>'admin1',
    'Cpass'=>'admin1',
    'birthdate'=>'2022-12-05',
    'gender'=>'1'
] ;


// var_dump(Register::register($req1));

//img::generate(captcha::getCaptcha());

// $code = Vcode::generate() ;

// $message = "
//     your verification code <br>
//     <input class='text-white text-5xl' type='text' readonly value='{$code}' >
// " ;
// DB::update(2,'tntAdmeago@gmail.com');

// img::generate($capthca);
var_dump($_SESSION);
$data = [
    'fname'=>'tt',
    'email'=>'tt@gmail.com',
    'surname'=>'tt',
    'pass'=>'j',
    'date'=>'e',
    'gender'=>'0',
    'captcha'=>'5'
];
Register::check($data);

// echo Mailer::send('verification' , $message)? 'hello':'error';

