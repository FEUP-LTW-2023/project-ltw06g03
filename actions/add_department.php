<?php  
    declare(strict_types=1);

    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/department.class.php');

    $db=getDatabaseConnection();

    $session = new Session();
    $name=$_GET['name'];
    $department= new Department($name);
    $department->new($db);
    header('Location: /pages/users.php');

?>