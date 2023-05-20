<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
$up=intval($_GET['up']);
$id=intval($_GET['id']);
$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('DELETE FROM ASSIGN WHERE UP==? AND TICKET_ID==?');
$stmt->execute(array($up,$id));
echo json_encode([''])
?>