<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/department.class.php');

$db = getDatabaseConnection();
$deparments = Department::getAllDepartments($db);
echo json_encode($deparments);

?>