<?php


require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn()) header('Location: /pages/home.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/message.class.php');
try{

$dbh = getDatabaseConnection();

$up=$session->getUp();
$id = intval($_GET['id']);
$text=$_GET['text'];
Message::new($dbh,$text,$id,$up);
echo json_encode(['']);
}catch ( Exception $exception){
    echo json_encode([$exception]);
}
?>
