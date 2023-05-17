<?php
    declare(strict_types=1);
    require_once('../utils/session.php');
    require_once('../templates/header.php');
    require_once('../templates/common.php');
    require_once('../templates/body.php');
    $session = new Session();

    $session->setDateOfRegister("2020-20-02");

    if (!$session->isLoggedIn()) {
        header('Location: home.php');
    }

    else {
        drawProfileHeader($session);
        drawNavBar($session);
        drawProfileBody($session);
        drawFooter();

    }


?>