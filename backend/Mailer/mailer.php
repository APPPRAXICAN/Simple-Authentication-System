<?php
namespace Mail ;
$Mconfig = include 'config.php';
class Mailer {
    public static function send($subject,$message ,$to='tntAdmeago@gmail.com'){
        global $Mconfig;
        extract($Mconfig);
        $msg = str_replace('here is', $message , $msg);
        return mail($to , $subject , $msg , $headers);
    }
}