<?php
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    if(!$session->isLoggedIn() || $_SESSION['csrf'] !== $_POST['csrf']) {
        header('Location: /pages/home.php');
        exit();
    }
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/filters.php');

    $user= User::getUser(getDatabaseConnection(),$session->getUp());
    echo json_encode($user);
?>

