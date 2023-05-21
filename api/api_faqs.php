<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/faq.class.php');
require_once(__DIR__ . '/../database/filters.php');

$db = getDatabaseConnection();

$search='';
$faqs = FAQ::getFaqs($db);

echo json_encode($faqs);
?>
