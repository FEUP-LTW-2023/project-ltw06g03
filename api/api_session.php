<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
$user= User::getUser(getDatabaseConnection(),$session->getUp());
echo json_encode($user);
?>

