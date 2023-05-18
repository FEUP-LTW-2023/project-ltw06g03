<?php
require_once(__DIR__ . '/connection.php');
$dbh = getDatabaseConnection();
$stmt = $dbh->prepare('INSERT INTO PERSON (UP, EMAIL,NAME,PASSWORD,IMG) VALUES (:up, :email,:name,:pass,:img)');
$up=intval($_POST['up']);
$stmt->bindParam(':name', $_POST['name']);
$stmt->bindParam(':up',$up );
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':pass', $_POST['pass']);
$file_contents = file_get_contents('../docs/default_pfp.png');
$base64 = base64_encode($file_contents);
$stmt->bindParam(':img', $base64);
$stmt->execute();
header('Location: /pages/home.php');
?>



