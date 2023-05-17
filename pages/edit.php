<?php

require_once('../utils/session.php');
require_once('../templates/header.php');
require_once('../templates/common.php');
require_once('../templates/edit_body.php');



//set Session
$session = new Session();

$session->setDateOfRegister("2020-20-02");

if (!$session->isLoggedIn()) {
    header('Location: home.php');
} else {
    drawEditHeader();
    drawNavBar($session);
    drawEditBody();
    drawFooter();

}


?>
