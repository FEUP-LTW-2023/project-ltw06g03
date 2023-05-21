<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn() ) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/event.class.php');
require_once(__DIR__ . '/../database/filters.php');

$db = getDatabaseConnection();
$id = encode_int($_GET['id']);

$events = Event::getTicketEvents($db, $id);

echo json_encode($events);
?>
