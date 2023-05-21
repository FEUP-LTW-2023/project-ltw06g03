<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
$dbh = getDatabaseConnection();
$user=new User(intval($_POST['up']),$_POST['name'],$_POST['email'],'','',[],'');
$user->new($dbh,password_hash ($_POST['pass'] , PASSWORD_DEFAULT, ['cost' => 13]));
header('Location: /pages/home.php');
?>



