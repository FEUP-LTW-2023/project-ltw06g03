<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../templates/home_body.php');
require_once(__DIR__ . '/../utils/session.php');
$session = new Session("Admin");
require_once(__DIR__ . '/../templates/common.php');
// drawHeader($session);
drawHomePageHeader();
drawNavBar($session);
drawHomeBody();

  drawFooter();
?>


