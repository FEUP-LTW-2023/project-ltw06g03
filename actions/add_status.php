<?php  
    declare(strict_types=1);
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    if(!$session->isStaff()){
        header('Location: /');
        exit();
    }
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/status.class.php');

    $db=getDatabaseConnection();

try {
    $name=$_GET['name'];
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $status= new Status($name);
    $status->new($db);
}catch (Exception $exception){

}
header('Location: /pages/users.php');

?>