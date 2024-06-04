<?php
namespace Auth ;
use database\DB ;

class Login{
    
    static function identify($request){
        if(!isset($request['email'],$request['pass']))return false ; 
        $email = $request['email'];
        $pass = hash('md5',$request['pass']);
        $emailCheck = DB::checker('email',$email);
        $passCheck = DB::checker('password',$pass);
        return $emailCheck&&$passCheck ;
    }
}