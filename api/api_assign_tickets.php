<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff())  {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');


$db = getDatabaseConnection();
$up=intval($_GET['up']);
$search='';
if(isset($_GET['search']))$search=$_GET['search'];
$status='';
if(isset($_GET['status'])) $status=$_GET['status'];
$department='';
if(isset($_GET['department'])) $department=$_GET['department'];
$tickets = Ticket::getAssignTickets($db, $up,$search,$status,$department);

echo json_encode($tickets);
?>

