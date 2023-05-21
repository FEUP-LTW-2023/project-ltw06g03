<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
/*if ($_SESSION['csrf'] !== $_POST['csrf']) {
    header('Location: /');
    exit();
}*/
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/filters.php');


$db = getDatabaseConnection();

try {

    $up = encode_int($_GET['up']);

    $pass = ($_GET['pass']);

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
           $session->setDateOfRegister($user->date);
            echo json_encode('');
       }else  {
            echo json_encode(['Password is incorrect']);
        }

    }


}catch (Exception $exception){
    echo json_encode([$exception]);
}
?>


