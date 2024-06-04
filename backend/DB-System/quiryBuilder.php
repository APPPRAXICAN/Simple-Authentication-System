<?php
namespace database; 

class DB  {
    private static $order ; 
    static function setConnection (DBConnection $conn){
        self::$order = $conn->conn ;
    }
    static function insert($table ,$attribute ,$values){
        $query = 'INSERT INTO '.$table.' ( ' ;
        foreach($attribute as $key){
            $query.=$key.',';
        }
        $query = substr($query,0,-1);
        $query.=') VALUES ( ' ;
        foreach($values as $val){
            $query.='"'.$val.'",';
        }
        $query = substr($query,0,-4);
        $query.=end($values).')';
        return self::$order->query($query);
    }
    static function select($table){
        $query = 'SELECT * FROM '.$table ;
        self::$order->query('select * from users;') ? 'success<br>' : 'someting went wrong<br>';
        return self::$order->query($query);
    }
    static function checker($forWhat,$forValue,$table='users'){
        $res = self::select($table);
        if($res->num_rows>0){
            while($row = $res->fetch_assoc()){
                if ($forValue == $row[$forWhat]){
                    return true;
                } 
            } 
        }
        return false ;
    }
    static function update($forValue ,$condition,$forWhat='email_confirmation',$table='users'){
        $query = "UPDATE {$table}
                SET {$forWhat}  = '{$forValue}' 
                WHERE email = '{$condition}'
        ";
        var_dump($query);
        return self::$order->query($query);
    }
}