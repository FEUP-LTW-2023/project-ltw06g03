<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');


$db = getDatabaseConnection();
$up=intval($_GET['up']);
$user = User::getUser($db, $up);
echo json_encode([$user]);
?>

