<?php

require_once('../utils/session.php');
require_once('../templates/header.php');
require_once('../templates/common.php');
require_once('../templates/body.php');


//set Session
$session = new Session();


if (!$session->isLoggedIn()) {
    header('Location: home.php');
}
if(!isset($_GET['up']))header('Location: profile.php?up='. $session->getUp());

else {
    drawProfileHeader($session);
    drawNavBar($session);
    drawProfileBody($session);
    drawFooter();

}


?>