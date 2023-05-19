<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/department.class.php');


$db = getDatabaseConnection();
$departments = Department::getDepartments($db);
echo json_encode($departments);
?>
