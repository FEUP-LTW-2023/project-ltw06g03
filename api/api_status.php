<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/status.class.php');


$db = getDatabaseConnection();
$status = Status::getStatus($db);
echo json_encode($status);
?>
