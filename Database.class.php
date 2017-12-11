<?php

class Database {
    protected $db_name = 'secondstage';
    protected $db_user = 'root';
    protected $db_pass = 'laxinar123';
    protected $db_host = 'localhost';
    
    function connect(){
        $link = mysqli_connect($this->db_host,$this->db_user,$this->db_pass,$this->db_name)
            or die ("Error: ".mysqli_error($link));
        if(!mysqli_set_charset($link,"utf8")){
            printf("Error: ".mysqli_error($link));
        }
        return $link;
    }
    
    public function update($data,$table,$where,$link) {
         $table = trim($table);
         $where = trim($where);
        
         $where = mysqli_real_escape_string($link,$where);
         $table = mysqli_real_escape_string($link,$table);
         foreach ($data as $column => $value) {
                $column = trim($column);
                $value = trim($value);
                $column = mysqli_real_escape_string($link,$column);
                $value = mysqli_real_escape_string($link,$value);
                
            
            $sql = "UPDATE users SET '$column' = '$value'' WHERE '$where'";
            mysqli_query($link,$sql) or die(mysqli_error($link));
        }
     
        return true;
    }
    
    public function insert($data,$table,$link) {
        $table = trim($table);
       
        $table = mysqli_real_escape_string($link,$table);
        $columns = "";
        $values = "";
        foreach ($data as $column => $value) {
            $columns .= ($columns == "") ? "" : ", ";
            $columns .= trim($column);
            $values .= ($values == "") ? "" : ", ";
            $values .= trim($value);
            $column = mysqli_real_escape_string($link,$column);
            $value = mysqli_real_escape_string($link,$value);
        }

        $sql = "INSERT into users ($columns) values ($values)";
        mysqli_query($link,$sql) or die(mysqli_error($link));

    return mysqli_insert_id($link);
    }
    
    public function select($table,$where,$link) {
         $table = trim($table);
         $where = trim($where);
         $where = mysqli_real_escape_string($link,$where);
         $table = mysqli_real_escape_string($link,$table);
        $sql = "SELECT * FROM users WHERE '$where'";
        $result = mysqli_query($link,$sql);
       
        if(!$result)
            die(mysqli_error($link));
    
        $n = mysqli_num_rows($result);
        $res = array();
    
        for($i = 0;  $i<$n;$i++)
        {
            $row = mysqli_fetch_assoc($result);
            $res[] = $row;
        
        }
        return   $res;
    }
}
?>