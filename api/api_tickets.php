<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$search = ($_GET['search']);
$tickets = Ticket::getTickets($db, $search);
echo json_encode($tickets);
?>
