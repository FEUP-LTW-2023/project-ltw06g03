<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isLoggedIn() /*|| $_SESSION['csrf'] !== $_POST['csrf']*/) {
    header('Location: /pages/home.php');
    exit();
}
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/filters.php');


$db = getDatabaseConnection();
$id=encode_int($_GET['id']);
$search='';
if(isset($_GET['search'])) $search=encode_string($_GET['search']);
$users = User::getUsersAssign($db, $id,$search);
echo json_encode($users);
?>

