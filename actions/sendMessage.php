<?php


require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
require_once(__DIR__ . '/../database/connection.php');
try{

$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO TICKET_MESSAGE (TEXT, TICKET_ID,PERSON_ID) VALUES (:text, :id,:up)');
$up=$session->getUp();
$id = intval($_GET['id']);
$stmt->bindParam(':text', $_GET['text']);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':up', $up);
$stmt->execute();
echo json_encode(['']);
}catch ( Exception $exception){
    echo json_encode([$exception]);
}
?>
