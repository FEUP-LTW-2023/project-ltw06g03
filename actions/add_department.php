<?php  
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
session_start();

if(!$session->isStaff() || $_SESSION['csrf'] !== $_POST['csrf']){
    header('Location: /');
    exit();
}

require_once(__DIR__ . '/../database/connection.php');
$db=getDatabaseConnection();

require_once(__DIR__ . '/../database/department.class.php');
require_once(__DIR__ . '/../database/filters.php');

$name = encode_string($_GET['name']);

$department= new Department($name);
$department->new($db);
header('Location: /pages/users.php');

?>