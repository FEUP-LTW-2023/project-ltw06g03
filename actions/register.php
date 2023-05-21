<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

$dbh = getDatabaseConnection();

require_once(__DIR__ . '/../database/filters.php');

$up = encode_int($_POST['up']);

$name = encode_string($_POST['name']);

$email = ($_POST['email']);

$pass = ($_POST['pass']);

$user=new User($up, $name, $email,'','',[],'');
$user->new($dbh,password_hash ($pass , PASSWORD_DEFAULT, ['cost' => 13]));
header('Location: /pages/home.php');
?>



