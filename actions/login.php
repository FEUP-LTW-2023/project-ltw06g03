<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

$db = getDatabaseConnection();

try {

    $up = intval($_GET['up']);
    $pass = $_GET['pass'];
    $user = User::getUser($db, $up);


    if (!$user) echo json_encode(["Account does not exist"]);
    else {
        $user=User::getUserWithPass($db,$up,$pass);
       if($user){
            $session->setUserUp($user->up);
            $session->setUsername($user->name);
            $session->setEmail($user->email);
            $session->setRole($user->role);
            $session->setUserImg($user->img);
            $session->setDepartments($user->departments);
            echo json_encode('');
       }else  {
            echo json_encode(['Password is incorrect']);
        }

    }


}catch (Exception $exception){
    echo json_encode([$exception]);
}
?>


