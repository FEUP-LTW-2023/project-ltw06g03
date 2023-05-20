<?php


declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php');

$db = getDatabaseConnection();

require_once(__DIR__ . '/../database/doubts.class.php');

$text = $_GET['text'];
$doubt = new Department($text);
$doubt->new($db);
header('Location: /pages/home.php');


?>
