<?php


require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()){
    header('Location: /pages/home.php');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/filters.php');

try{

    $text = encode_string($_GET['text']);

    $id = encode_int($_GET['id']);

    $up=$session->getUp();

    $dbh = getDatabaseConnection();
    $stmt = $dbh->prepare('INSERT INTO TICKET_MESSAGE (TEXT, TICKET_ID,PERSON_ID) VALUES (:text, :id,:up)');

    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':up', $up);
    $stmt->execute();
    echo json_encode(['']);
}catch ( Exception $exception){
    echo json_encode([$exception]);
}
?>
