<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$search = ($_GET['search']);
$status='';
$department='';
if(isset($_GET['department'])) $department=$_GET['department'];
if(isset($_GET['status'])) $status=$_GET['status'];
$tickets = Ticket::getTickets($db, $search,$status,$department);

echo json_encode($tickets);
?>
