<?php
//register.php

require_once 'global.inc.php';

$username = "";
$password = "";

$email = "";
$error ="";

if(isset($_POST['submit-form'])) { 

$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];



$success = true;
$userTools = new UserTools();

if($userTools->checkUsernameExists($username))
{
    $_SESSION['error'] = "Такой пользователь уже существует";
    header("Location: registration");
    $success = false;
}



if($success)
{
$data['name'] = $username;
$data['password'] = $password;
$data['mail'] = $email;

$newUser = new User($data);

$newUser->save(true);


$userTools->login($username,$password,$link);
$user = unserialize($_SESSION['user']); 
header("Location: welcome.php");
}
}



?>
