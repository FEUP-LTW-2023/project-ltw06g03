<?php
    declare(strict_types=1);
    require_once('../utils/session.php');
    require_once('../templates/header.php');
    require_once('../templates/common.php');
    require_once('../templates/body.php');
    $session = new Session();


    if (!$session->isLoggedIn()) {
        header('Location: home.php');
    }

    else {

        //set Session
        $session->setUsername("Capitulino");
        $session->setEmail("capitulino@andreioleta.com");
        $session->setUp(123456789);
        $session->setUserImg("../docs/feup.png");
        //$session->setUserImg(null);
        $session->setDepartments(array("DEI", "DCC"));
        $session->setDateOfRegister("2020-20-02");

        drawProfileHeader($session);
        drawNavBar($session);
        drawProfileBody($session);
        drawFooter();

    }


?>