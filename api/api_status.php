<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn() ) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/status.class.php');


$db = getDatabaseConnection();
$status = Status::getStatus($db);
echo json_encode($status);
?>
