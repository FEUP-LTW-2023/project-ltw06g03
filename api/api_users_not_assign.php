<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');


$db = getDatabaseConnection();
$id=intval($_GET['id']);
$users = User::getUsersNotAssign($db, $id);
echo json_encode($users);
?>

