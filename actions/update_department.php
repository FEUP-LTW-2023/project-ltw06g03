<?php 
declare(strict_types=1);
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
if(!$session->isStaff()) header('Location: /pages/home.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/department.class.php');

$db = getDatabaseConnection();

try {
    $up = intval($_GET['UP']);
    $user = User::getUser($db, $up);
    $departments = Department::getUsersDepartments($db, $up);
    $departmentName = $_GET['department'];
    $department = Department::getDepartment($db, $departmentName);
    $check = false;
    for ($i = 0; $i < count($departments); $i++) {
       
        if ($departments[$i] == $departmentName) {
            unset($departments[$i]);
            $check = true;
            $user->departments = $departments;
            $department->changeUserDepartment($db, $up, "DELETE");
            break;
        }
    }

    if (!$check) {
        $departments[]=$department;
        $user->departments = $departments;
        $department->changeUserDepartment($db, $up, "INSERT");
    
    }

    echo json_encode(['']);
} catch (Exception $exception) {
    echo json_encode([$exception]);
}

?>
