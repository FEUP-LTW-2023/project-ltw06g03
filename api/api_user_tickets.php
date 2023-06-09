<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn() ) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/filters.php');


$db = getDatabaseConnection();
$up=encode_int($_GET['up']);
$search='';
if(isset($_GET['search']))$search=encode_string($_GET['search']);
$status='';
if(isset($_GET['status'])) $status=encode_string($_GET['status']);
$department='';
if(isset($_GET['department'])) $department=encode_string($_GET['department']);
$tickets = Ticket::getUserTickets($db, $up,$search,$status,$department);

echo json_encode($tickets);
?>

