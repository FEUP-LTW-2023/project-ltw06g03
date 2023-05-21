<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff() || $_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/filters.php');



$db = getDatabaseConnection();
$search = ($_GET['search']);
$status='';
$department='';
if(isset($_GET['department'])) $department=encode_string($_GET['department']);
if(isset($_GET['status'])) $status=encode_string($_GET['status']);
$tickets = Ticket::getTickets($db, $search,$status,$department);

echo json_encode($tickets);
?>
