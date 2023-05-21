<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()){
    header('Location: /');
}
require_once(__DIR__ . '/../database/ticket.class.php');
$up=intval($_GET['up']);
$id=intval($_GET['id']);
$dbh = getDatabaseConnection();
Ticket::assign($dbh,$id,$up);
echo json_encode([''])
?>
