<?php
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/filters.php');


$db = getDatabaseConnection();
$up=encode_int($_GET['up']);
$user = User::getUser($db, $up);
echo json_encode([$user]);
?>

