<?php

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff() || $_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: /pages/home.php');
    exit();
}

require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/filters.php');


$status = encode_string($_GET['status']);

$department = encode_string($_GET['department']);

$id = encode_int($_GET['id']);

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
