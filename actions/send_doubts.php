<?php


declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/../database/doubt.class.php');
try {
    $text = $_GET['text'];
    $doubt = new Doubt($text);
    $doubt->new($db);
    header('Location: /pages/home.php');
}catch (Exception $exception){
    header('Location: /pages/home.php');
}

?>
