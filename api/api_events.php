<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/event.class.php');


$db = getDatabaseConnection();
$id = intval($_GET['id']);

$events = Event::getTicketEvents($db, $id);

echo json_encode($events);
?>
