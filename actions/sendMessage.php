<?php


require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn() /*|| $_SESSION['csrf'] !== $_POST['csrf']*/){
    header('Location: /pages/home.php');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/filters.php');

require_once(__DIR__ . '/../database/message.class.php');
try{

    $text = encode_string($_GET['text']);

    $id = encode_int($_GET['id']);

    $up=$session->getUp();

    $dbh = getDatabaseConnection();

    Message::new($dbh,$text,$id,$up);
    echo json_encode(['']);
}catch ( Exception $exception){
    echo json_encode([$exception]);
}
?>
