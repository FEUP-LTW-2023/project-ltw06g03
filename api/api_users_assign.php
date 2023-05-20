<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');


$db = getDatabaseConnection();
$id=intval($_GET['id']);
$search='';
if(isset($_GET['search'])) $search=$_GET['search'];
$users = User::getUsersAssign($db, $id,$search);
echo json_encode($users);
?>

