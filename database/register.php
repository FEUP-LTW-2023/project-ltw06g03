<?php
require_once(__DIR__ . '/connection.php');
$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO PERSON (UP, EMAIL,NAME,PASSWORD) VALUES (:up, :email,:name,:pass)');
$up=intval($_POST['up']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':up',$up );
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':pass', $_POST['pass']);
$stmt->execute();
header("Location: http://localhost:9000/pages/home.php");
?>



