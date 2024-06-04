<?php

namespace Auth;

// require('../Mailer/mailer.php');
// require('../Mailer/Verification-code/codeGenerator.php');
use database\DB;
use Mail\Mailer ;
use Mail\Vcode;


class Register
{
    private static $fname;
    private static $surname;
    private static $password;
    private static $email;
    private static $date;
    private static $captcha;
    private static $gender;
    private static $values;
    private const attribute = ['first_name', 'surname', 'email', 'password', 'birthdate', 'gender'];

    public static function check($data)
    {
        self::$fname = $data['fname'];
        self::$surname = $data['surname'];
        self::$password= $data['pass'];
        self::$email = $data['email'];
        self::$date = $data['date'];
        self::$captcha = $data['captcha'];
        self::$gender = $data['gender'];
        if (DB::checker('email', self::$email)) {
            exit(json_encode(['status' => -1, 'msg' => 'email is already in use']));
        }
        if (isset($_SESSION['captcha'])) {
            if (strtoupper(self::$captcha) != $_SESSION['captcha']) {
                exit(json_encode(['status' => -2, 'msg' => "captcha is invalid you entered {$data['captcha']} and your captcha was {$_SESSION['captcha']}"]));
            }
        } else {
            exit(json_encode(['msg' => 'captcha session not set']));
        }
    }
    private static function save()
    {
        self::$password = hash('md5', self::$password);
        self::$values = [
            self::$fname, self::$surname, self::$email,self::$password, self::$date, self::$gender
        ];
        return DB::insert('users',self::attribute ,self::$values);
    }
    public static function verify($postedCode , $generatedCode){
        $_SESSION['error']='';
        if($postedCode === $generatedCode) {
            DB::update(1 , self::$email);
            header('Location:../authenticated.html');
        } 
        else{
            $_SESSION['error'] = 'invalid verification code' ;
            // echo $_SESSION['code'] .'<br>'.$_POST['verify-code'];
            header('Location:../Email-Verification.php');
        }
    }
    public static function save_sendMail(){
        if(self::save()){
            $_SESSION['email'] = self::$email;
            $_SESSION['code'] = Vcode::generate();
            $msg = "
            <p class='text-white text-3xl'>Your Verification Code is :</p><br>
            <input class='text-white  p-2 m-auto' readonly value={$_SESSION['code']}>
            " ;
            Mailer::send('Verification Code',$msg ,self::$email);
            exit(json_encode(['status'=>0]));
        }else{
            exit(json_encode(['status'=>-1]));
        }
    }
}