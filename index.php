<?php
require_once(__DIR__ . '/templates/header.php');
require_once(__DIR__ . '/templates/home_body.php');

require_once(__DIR__ . '/utils/session.php');
$session = new Session();
$session->loggout();
header('Location: pages/home.php');

?>