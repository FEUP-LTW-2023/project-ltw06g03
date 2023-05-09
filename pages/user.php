<?php

    require_once('../utils/session.php');
    require_once('../templates/header.php');
    require_once('../templates/common.php');
    require_once('../templates/user_body.php');

    //set Session
    $session = new Session("Admin");
    $session->setUsername("Capitulino");
    $session->setEmail("capitulino@andreioleta.com");
    $session->setUp(123456789);
    $session->setUserImg(null);
    $session->setDepartments(array("DEI", "DCC"));
    $session->setDateOfRegister("2020-20-02");

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