<?php
declare(strict_types = 1);


require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

$db = getDatabaseConnection();
$up=intval($_GET['up']);
$artists = User::getUser($db, $up);
echo json_encode([$artists]);
?>

