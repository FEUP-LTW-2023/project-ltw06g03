<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$search = ($_GET['search']);
$status='';
if(isset($_GET['status'])) $status=$_GET['status'];
$tickets = Ticket::getTickets($db, $search,$status);
echo json_encode($tickets);
?>
