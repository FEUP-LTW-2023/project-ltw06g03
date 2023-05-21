<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff() ){
    header('Location: /');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/event.class.php');
require_once(__DIR__ . '/../database/filters.php');

$db = getDatabaseConnection();


$id = encode_int($_GET['id']);

$up = $session->getUp();

$text = encode_string($_GET['description']);
$dbh = getDatabaseConnection();
Event::new($dbh,$text,$up,$id);
echo json_encode(['']);
?>
