<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()){
    header('Location: /');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/event.class.php');


$db = getDatabaseConnection();

$id = intval($_GET['id']);
$up = $session->getUp();
$text= $_GET['description'];
$text = stripslashes($text);
$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO EVENT (DESCRIPTION, CLIENT_ID,TICKET_ID) VALUES (?, ?,?)');
$stmt->execute(array($text,$up,$id));
echo json_encode(['']);
?>
