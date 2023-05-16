<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');


$db = getDatabaseConnection();

$up = intval($_GET['up']);

if($up) {
    $users = User::searchUser($db, $up);
    echo json_encode($users);
}

else {
    $name = $_GET['name'];
    $users = User::searchUser($db, $name);
    echo json_encode($users);
}


?>
