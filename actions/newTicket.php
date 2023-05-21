<?php


require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
try {

    $dbh = getDatabaseConnection();
    $stmt = $dbh->prepare('INSERT INTO TICKET (TITLE, PROBLEM,CLIENT_ID,DEPARTMENT) VALUES (:title, :problem,:up,:dep)');
    $up = $session->getUp();
    $stmt->bindParam(':title', $_GET['title']);
    $stmt->bindParam(':problem', $_GET['text']);
    $stmt->bindParam(':up', $up);
    $stmt->bindParam(':dep',$_GET['department']);
    $stmt->execute();
    echo json_encode(['']);
} catch (Exception $exception) {
    echo json_encode($exception);
}


?>
