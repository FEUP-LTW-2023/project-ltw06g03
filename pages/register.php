<?php

declare(strict_types=1);
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../templates/header.php');
require_once(__DIR__ . '/../templates/register_body.php');
$session = new Session();
require_once(__DIR__ . '/../templates/common.php');


drawRegisterPageHeader();
drawNavBar($session);
drawRegister();
drawFooter();
?>
