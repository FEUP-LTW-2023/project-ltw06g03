<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn() ) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/filters.php');

$db = getDatabaseConnection();
$departments = Department::getAllDepartments($db);
echo json_encode($departments);

?>


