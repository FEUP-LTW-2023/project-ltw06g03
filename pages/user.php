<?php

    require_once('../utils/session.php');
    require_onde('../templates/header.php');
    require_once('../templates/common.php');
    require_once('../templates/user_body.php');
    //$session = new Session("Admin");

    if (!$session->isLoggedIn()) {
        header('Location: home.php');
    }

    else {
        drawUserHeader($session);
        drawNavBar($session);
        drawUserBody($session);
        drawFooter();

    }


?>