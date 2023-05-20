<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/ticket.class.php');
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
$status=$_GET['status'];
$department=$_GET['department'];
$id=$_GET['id'];
$dbh = getDatabaseConnection();
try {
    $ticket= Ticket::getTicket($dbh,$id);
    if($ticket===null)echo json_encode(['Ticket does not exist']);
    $ticket->status=$status;
    $ticket->department=$department;
    $ticket->save($dbh);
    echo json_encode(['']);
}catch (Exception $exception){
    echo json_encode(['Error occur']);
}

?>