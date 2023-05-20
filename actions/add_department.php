<?php  
    declare(strict_types=1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    if($session->isStaff()){
        header('Location: /');
    }
    $db=getDatabaseConnection();

require_once(__DIR__ . '/../database/department.class.php');


$name=$_GET['name'];
    $department= new Department($name);
    $department->new($db);
    header('Location: /pages/users.php');

?>