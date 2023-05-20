<?php


require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/connection.php');
$db=getDatabaseConnection();
try {
    $responseMessage='';
    $session = new Session();
    $user= User::getUser($db,$session->getUp());
    $user->name=$_POST['name'];
    $user->email=$_POST['email'];
    $targetPath='/docs/images/default_pfp.png';
    if($_POST['pass']!=='')$user->pass=$_POST['pass'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($_FILES["img"]["size"] > 0) {
            $uploadOk = 1;
            $targetDir = "../docs/profile/"; // Specify the directory where you want to store the uploaded images
            $imageFileType = strtolower(pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION));
            $imageName = $session->getUp();



            $uniqueFilename = $imageName . '.' . $imageFileType;
            $targetPath = $targetDir . $uniqueFilename;



            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if ($check === false) {
                $responseMessage = "Invalid images file.";
                $uploadOk = 0;
            }

            if ($_FILES["img"]["size"] > 10000000) {
                $responseMessage = "File size exceeds the limit.";
                $uploadOk = 0;
            }

            if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg") {
                $responseMessage = "Only JPG, JPEG, and PNG files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk === 0) {
                echo json_encode([$responseMessage]);
                return;
            } else {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetPath)) {
                    if (file_exists($user->img) and $user->img!== '/docs/images/default_pfp.png') {
                        if (unlink($user->img)) {

                        }
                    }
                    $user->img=$targetPath;

                }
                else{
                    $responseMessage = "Image upload failed.";
                }
            }
        }
    }
    $user->save($db);
    $session->setUsername($_POST['name']);
    $session->setEmail($_POST['email']);
    echo json_encode([$responseMessage]);
} catch (Exception $exception) {
    echo json_encode([$exception]);
}

?>