<?php

//UserTools.class.php
require_once 'User.class.php';
require_once 'Database.class.php';

class UserTools {

//Log the user in. First checks to see if the
//username and password match a row in the database.
//If it is successful, set the session variables
//and store the user object within.
public function login($username,$password,$link)

    {
       

        $username = trim($username);
        $password = trim($password);
        $hashedPassword =$password;
     
        $query = sprintf("SELECT * FROM users WHERE name='%s' AND 
        password = '%s'" ,mysqli_real_escape_string($link,$username),mysqli_real_escape_string($link,$password));
        $result = mysqli_query($link,$query);
       
        if(mysqli_num_rows($result))
        {
            
            $_SESSION["user"] = serialize(new User(mysqli_fetch_assoc($result)));
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
          
            return true;
        }else{
            return false;
        }
}


public function logout() {
    
    unset($_SESSION['user']);
    unset($_SESSION['login_time']);
    unset($_SESSION['logged_in']);
    session_destroy();
}

public function checkUsernameExists($username) {
    
     $db = new Database();
     $link=$db->connect();
     $username = trim($username);
     $query = sprintf("SELECT id FROM users WHERE name='%s'",mysqli_real_escape_string($link,$username));
    
  
   
    $result = mysqli_query($link,$query);
    if(mysqli_num_rows($result) == 0)
    {
        return false;
    }else{
        return true;
    }

}


public function get($id)
{
    $db = new Database();
    $link=$db->connect();
    $result = $db->select('users',"id = $id",$link);
    return new User($result);
    }
}

?>