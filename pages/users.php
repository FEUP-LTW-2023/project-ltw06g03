<?php 
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/header.php');
    require_once(__DIR__ . '/../templates/common.php');
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../templates/body.php');
    $session = new Session();

    if (!$session->isLoggedIn()) {
        header('Location: home.php');
    }

    else {
        $db = getDatabaseConnection();
    
        $users = User::getUsers($db);

        drawUsersHeader();
        drawNavBar($session);
        drawUsersBody($users);
        drawFooter();

    }
    
?>