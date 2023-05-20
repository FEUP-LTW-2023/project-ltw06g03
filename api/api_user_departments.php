<?php 
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/department.class.php');

$db = getDatabaseConnection();
$up = intval($_GET['UP']);
$user = User::getUser($db, $up);
$deparments = Department::getUsersDepartments($db, $up);
echo json_encode($deparments);
?>