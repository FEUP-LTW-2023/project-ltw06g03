<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$up=intval($_GET['up']);
$tickets = Ticket::getUserTickets($db, $up);
echo json_encode($tickets);
?>

