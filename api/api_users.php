<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff() ) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/filters.php');

$db = getDatabaseConnection();

$up = encode_int($_GET['up']);

if($up) {
    $users = User::searchUser($db, $up);
    echo json_encode($users);
}

else {
    $name = encode_string($_GET['up']);
    $users = User::searchUser($db, $name);
    echo json_encode($users);
}


?>
