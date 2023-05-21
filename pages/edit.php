<?php

require_once('../utils/session.php');
require_once('../templates/header.php');
require_once('../templates/common.php');
require_once('../templates/edit_body.php');

$session = new Session();

if (!$session->isLoggedIn()) {
    header('Location: home.php');
} else {
    drawEditHeader();
    drawNavBar($session);
    drawEditBody();
    drawFooter();

}


?>
