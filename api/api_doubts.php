<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/doubt.class.php');


$db = getDatabaseConnection();


$doubts = Doubt::getDoubts($db);

echo json_encode($doubts);
?>
