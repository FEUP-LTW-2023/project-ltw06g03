<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn() || $_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/filters.php');


$db = getDatabaseConnection();
$up = encode_int($_GET['UP']);
$user = User::getUser($db, $up);
$deparments = Department::getUsersDepartments($db, $up);
echo json_encode($deparments);
?>