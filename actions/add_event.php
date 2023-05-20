<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/event.class.php');
require_once(__DIR__ . '/../utils/session.php');


$db = getDatabaseConnection();
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
$id = intval($_GET['id']);
$up = $session->getUp();
$text= $_GET['description'];
$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO EVENT (DESCRIPTION, CLIENT_ID,TICKET_ID) VALUES (?, ?,?)');
$stmt->execute(array($text,$up,$id));
echo json_encode(['']);
?>
