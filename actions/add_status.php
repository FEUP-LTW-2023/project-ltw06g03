<?php  
    declare(strict_types=1);
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    if($session->isStaff()){
        header('Location: /');
    }
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/status.class.php');

    $db=getDatabaseConnection();


    $name=$_GET['name'];
    $status= new Status($name);
    $status->new($db);
    header('Location: /pages/users.php');

?>