<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()){
    header('Location: /');
}
$db=getDatabaseConnection();

require_once(__DIR__ . '/../database/faq.class.php');


$title=$_GET['title'];
$text=$_GET['text'];
$department= new FAQ($title,$text);
$department->new($db);
header('Location: /pages/users.php');

?>