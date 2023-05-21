<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()){
    header('Location: /');
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/event.class.php');

$db = getDatabaseConnection();

$id = intval($_GET['id']);
$up = $session->getUp();
$text= $_GET['description'];
$dbh = getDatabaseConnection();
Event::new($dbh,$text,$up,$id);
echo json_encode(['']);
?>
