<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');


$db = getDatabaseConnection();

$up = intval($_GET['up']);

if($up) {
    $users = User::searchUser($db, $up);
    echo json_encode($users);
}

else {
    $name = $_GET['up'];
    $users = User::searchUser($db, $name);
    echo json_encode($users);
}


?>
