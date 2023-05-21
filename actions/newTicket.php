<?php

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/filters.php');

require_once(__DIR__ . '/../database/ticket.class.php');
try {
    
    $title = encode_string($_GET['title']);

    $problem = encode_string($_GET['problem']);

    $up = $session->getUp();
    
    $department = encode_string($_GET['department']);

    $dbh = getDatabaseConnection();
    Ticket::new($dbh,$title,$text,$up,$dep);
    echo json_encode(['']);
} catch (Exception $exception) {
    echo json_encode($exception);
}


?>
