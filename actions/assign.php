<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if($session->isStaff()){
    header('Location: /');
}
$up=intval($_GET['up']);
$id=intval($_GET['id']);
$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO ASSIGN (UP, TICKET_ID) VALUES (?, ?)');
$stmt->execute(array($up,$id));
echo json_encode([''])
?>
