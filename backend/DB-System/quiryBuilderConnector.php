<?php

namespace database ;
use Exception;
$DBconfig = require 'config.php';
class DBConnection{
    public $conn ;
    function __construct()
    { 
        global $DBconfig;
        extract($DBconfig);
        try{
            $this->conn = new \mysqli($host,$user,$pass,$DB,$port);  
            // echo $this->conn?'<br>Connected<br>':'<br>faild<br>';
        }catch(Exception $e){
            echo $e->getMessage();
        }
        return $this->conn;
    }
}