<?php

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/filters.php');

try {
    
    $title = encode_string($_GET['title']);

    $problem = encode_string($_GET['problem']);

    $up = $session->getUp();
    
    $department = encode_string($_GET['department']);

    $dbh = getDatabaseConnection();
    $stmt = $dbh->prepare('INSERT INTO TICKET (TITLE, PROBLEM,CLIENT_ID,DEPARTMENT) VALUES (:title, :problem,:up,:dep)');
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':problem', $problem);
    $stmt->bindParam(':up', $up);
    $stmt->bindParam(':dep',$department);
    $stmt->execute();
    echo json_encode(['']);
} catch (Exception $exception) {
    echo json_encode($exception);
}


?>
