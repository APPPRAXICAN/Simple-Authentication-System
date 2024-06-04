<?php
namespace Mail ;
class Vcode {
    public static function generate (){
        $nums = range(0,9);
        $indices=array_rand($nums ,5);
        $code = array();
        foreach($indices as $index){
            array_push($code,$nums[$index]);
        }
        return implode('',$code);
    }
}