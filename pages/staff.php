<?php 
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/header.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../templates/body.php');
    $session = new Session();
    
    drawStaffHeader();
    drawNavBar($session);
    drawStaffBody();
    drawFooter();

?>