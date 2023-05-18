<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$up = ($_GET['up']);
$tickets = Ticket::getTickets($db, $up);
echo json_encode($tickets);
?>
