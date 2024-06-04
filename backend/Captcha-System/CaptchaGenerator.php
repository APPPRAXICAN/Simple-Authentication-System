<?php
namespace captcha ;

class CaptchaGenerator {
    private static function generate(){
        $alphabet = range('A','Z') ;
        $numeric = range(0,9) ;
        $alpha = array_rand($alphabet,4);
        $nums = array_rand($numeric,3);
        return ['alpha'=>$alpha ,'nums'=> $nums
                ,'alphabet'=>$alphabet ,'numeric'=>$numeric] ;
    }
    private static function getVal($arr ,$index){
        $res = array();
        foreach($index as $i){
            array_push($res,$arr[$i]);
        }
        return $res;
    }
    private static function linear($arr){
        $res=array();
        foreach($arr as $innerArr){
            foreach($innerArr as $val){
                array_push($res,$val);
            }
        }
        return $res;
    }
    static function getCaptcha(){
        extract(self::generate());
        $numbers= self::getVal($numeric,$nums);
        $alphas = self::getVal($alphabet,$alpha);
        $captcha = array_map(null,$alphas,$numbers);
        $captcha= self::linear($captcha);
        return implode("",$captcha);
    }
}