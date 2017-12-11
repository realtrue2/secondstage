<?php

require_once 'User.class.php';
require_once 'UserTools.class.php';
require_once 'Database.class.php';


$db = new Database();
$link = $db->connect();

$userTools = new UserTools();

$_SESSION["error"] = "";
session_start();



?>