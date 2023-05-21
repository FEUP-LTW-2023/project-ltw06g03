<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isAdmin()) {
    header('Location: /pages/home.php');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/filters.php');



$db = getDatabaseConnection();

try {

    $up = encode_int($_GET['UP']);

    $user= User::getUser($db,$up);

    $role = encode_string($_GET['role']);

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