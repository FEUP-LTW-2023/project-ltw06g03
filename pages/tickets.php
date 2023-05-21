<?php

require_once('../utils/session.php');
require_once('../templates/header.php');
require_once('../templates/common.php');
require_once('../templates/ticket_body.php');


$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: home.php');
} else {
    drawTicketHeader();
    drawNavBar($session);
    drawTicketBody($session);
    drawFooter();

}


?>
