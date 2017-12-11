<?php

require_once 'global.inc.php';
$error = "";
$username = "";
$password = "";


if(isset($_POST['submit-login'])) { 

$username = $_POST['username'];
$password = $_POST['password'];

$userTools = new UserTools();
if($userTools->login($username, $password,$link)){

header("Location: private/index.php");
}else{              
            $_SESSION['error'] = "Неверный логин или пароль";
            header("Location: users/");
}
}
?>

