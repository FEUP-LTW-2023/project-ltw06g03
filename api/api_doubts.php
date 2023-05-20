<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()) header('Location: /pages/home.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/doubts.class.php');


$db = getDatabaseConnection();


$doubts = Doubts::getDoubts($db);

echo json_encode($doubts);
?>
