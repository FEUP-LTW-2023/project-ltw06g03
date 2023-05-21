<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/faq.class.php');


$db = getDatabaseConnection();

$search='';
if(isset($_GET['search']))$search=$_GET['search'];
$faqs = FAQ::getFaqs($db,$search);

echo json_encode($faqs);
?>
