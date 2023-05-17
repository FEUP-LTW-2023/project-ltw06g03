<?php


require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/connection.php');
$db=getDatabaseConnection();
try {
    $session = new Session();
    $user= User::getUser($db,$session->getUp());
    $user->name=$_POST['name'];
    $user->email=$_POST['email'];
    $user->pass=$_POST['pass'];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ( $_FILES['img']['size']) {
        $imageData = file_get_contents($_FILES["img"]["tmp_name"]);
        $base64 = base64_encode($imageData);
        $user->img=$base64;
        $session->setUserImg("data:image/*;base64," . $base64);
        $user->uploadImg($db,$base64);
    } else {
        print_r($_FILES);
        echo "Image upload error.";
    }}
    $user->save($db);

} catch (Exception $exception) {
    echo json_encode([$exception]);
}

?>