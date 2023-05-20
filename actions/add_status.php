<?php  
    declare(strict_types=1);

    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/status.class.php');

    $db=getDatabaseConnection();

    $session = new Session();
    $name=$_GET['name'];
    $status= new Status($name);
    $status->new($db);
    header('Location: /pages/users.php');

?>