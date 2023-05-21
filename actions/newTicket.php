<?php


require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/ticket.class.php');
try {

    $dbh = getDatabaseConnection();
    $up = $session->getUp();
    $title= $_GET['title'];
    $text= $_GET['text'];
    $dep=$_GET['department'];
    Ticket::new($dbh,$title,$text,$up,$dep);
    echo json_encode(['']);
} catch (Exception $exception) {
    echo json_encode($exception);
}


?>
