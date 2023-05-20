<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');


$db = getDatabaseConnection();
$session = new Session();
try {

    $up = intval($_GET['UP']);
    $user= User::getUser($db,$up);
    $role = $_GET['role'];


    if ($user->role === $role) {
        echo json_encode(["Role is the same"]);
    }

    elseif (!in_array($role, ['Student', 'Staff', 'Admin'])) {
        echo json_encode(["Role does not exist"]);
    } 
    else {
        $user->role = $role;
        $user->save($db);
        if($up==$session->getUp()) {
            $session->setRole($role);
        }
        echo json_encode(['']);
    }        


}catch (Exception $exception){
    echo json_encode([$exception]);
}


?>