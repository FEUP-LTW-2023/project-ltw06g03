<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../templates/faqs.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
require_once(__DIR__ . '/../templates/common.php');

drawFaqPageHeader();
drawNavBar($session);
drawFaqSection();
drawFooter();
?>


