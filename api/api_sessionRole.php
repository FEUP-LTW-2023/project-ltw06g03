<?php
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    if ($session-> isLoggedIn() && $session->isAdmin()) {
        echo json_encode([$session->getRole()]);
    }
    else {
        echo json_encode([]);
    }
?>

