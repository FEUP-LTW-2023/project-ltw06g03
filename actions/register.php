<?php
require_once(__DIR__ . '/../database/connection.php');
$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO PERSON (UP, EMAIL,NAME,PASSWORD) VALUES (:up, :email,:name,:pass)');
$up=intval($_POST['up']);
$pass=password_hash ($_POST['pass'] , PASSWORD_DEFAULT, ['cost' => 13]);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':up',$up );
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':pass',$pass );
$stmt->execute();
header('Location: /pages/home.php');
?>



