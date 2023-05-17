<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
try{
$session = new Session();
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
