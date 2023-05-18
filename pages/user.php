<?php

    require_once('../utils/session.php');
    require_once('../templates/header.php');
    require_once('../templates/common.php');
    require_once('../templates/user_body.php');


    //set Session
    $session = new Session();

    $session->setDateOfRegister("2020-20-02");

    if (!$session->isLoggedIn()) {
        header('Location: home.php');
    }
    if(!isset($_GET['up']))header('Location: user.php?up='. $session->getUp());

    else {
        drawUserHeader($session);
        drawNavBar($session);
        drawUserBody($session);
        drawFooter();

    }


?>