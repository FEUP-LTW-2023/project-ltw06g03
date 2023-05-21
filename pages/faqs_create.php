<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../templates/faqs.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
require_once(__DIR__ . '/../templates/common.php');
if(!$session->isStaff() ) {
    header('Location: /pages/home.php');
    exit();
}

drawFaqPageHeader();
drawNavBar($session);
drawFaqBody();
drawFooter();
?>


