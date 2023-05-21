<?php  
    declare(strict_types=1);
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    if(!$session->isStaff() || $_SESSION['csrf'] !== $_POST['csrf']){
        header('Location: /');
        exit();
    }
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/status.class.php');
    require_once(__DIR__ . '/../database/filters.php');


    $db=getDatabaseConnection();

try {
    
    $name = encode_string($_GET['name']);
    
    $status= new Status($name);
    $status->new($db);
}catch (Exception $exception){

}
header('Location: /pages/users.php');

?>