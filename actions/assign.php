<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff() || $_SESSION['csrf'] !== $_POST['csrf']){
    header('Location: /');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/filters.php');


$up = encode_int($_GET['up']);

$id = encode_int($_GET['id']);

$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO ASSIGN (UP, TICKET_ID) VALUES (?, ?)');
$stmt->execute(array($up,$id));
echo json_encode([''])
?>
