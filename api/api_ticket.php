<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$id=intval($_GET['id']);
$ticket = Ticket::getTicket($db, $id);
echo json_encode($ticket);
?>

