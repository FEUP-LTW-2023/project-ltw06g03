<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$up=intval($_GET['up']);
$search='';
if(isset($_GET['search']))$search=$_GET['search'];
$status='';
if(isset($_GET['status'])) $status=$_GET['status'];
    $tickets = Ticket::getUserTickets($db, $up,$search,$status);

echo json_encode($tickets);
?>

