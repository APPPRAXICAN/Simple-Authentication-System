<?php
namespace captcha ;
use captcha\CaptchaGenerator as Captcha ;

class ImageGenerator {
    private const path ='D:/Xampp/htdocs/websites/subsytems/login-registration-subsystem/backend/storage/captcha/';
    static $returnedPath = '' ;
    static function generate($captcha){
        $path = self::path . '/' .md5(uniqid()).time() .'.png' ;
        self::$returnedPath = str_replace('D:/Xampp/htdocs' , '',$path);
        $width = 400 ;
        $height =200 ;
        $background_rbg =[74,74,74];
        $img = Imagecreate($width,$height);
        imagecolorallocate($img,$background_rbg[0],$background_rbg[1],$background_rbg[2]);
        $font = 'D:\Xampp\Font\Roboto-italic.ttf';
        $foreground_rbg=[46,46,46];
        $angle = rand(10 ,40);
        $textColor = imagecolorallocate($img,$foreground_rbg[0],$foreground_rbg[1],$foreground_rbg[2]);
        imagettftext($img,50 ,$angle ,100,200,$textColor,$font,$captcha);
        imagepng($img,$path);
        imagedestroy($img);
    }
}