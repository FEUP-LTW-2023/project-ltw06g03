<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
try {
    $session = new Session();
    if(!$session->isLoggedIn()) header('Location: /pages/home.php');
    $dbh = getDatabaseConnection();
    $stmt = $dbh->prepare('INSERT INTO TICKET (TITLE, PROBLEM,CLIENT_ID) VALUES (:title, :problem,:up)');
    $up = $session->getUp();
    $stmt->bindParam(':title', $_GET['title']);
    $stmt->bindParam(':problem', $_GET['text']);
    $stmt->bindParam(':up', $up);
    $stmt->execute();
    echo json_encode(['']);
} catch (Exception $exception) {
    echo json_encode([$exception]);
}


?>
