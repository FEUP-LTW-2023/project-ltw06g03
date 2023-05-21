<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()){
    header('Location: /');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
$db=getDatabaseConnection();

require_once(__DIR__ . '/../database/faq.class.php');
require_once(__DIR__ . '/../database/filters.php');


$title = encode_string($_GET['title']);

$text = encode_string($_GET['text']);

$department= new FAQ($title,$text);
$department->new($db);
header('Location: /pages/faqs_create.php');

?>