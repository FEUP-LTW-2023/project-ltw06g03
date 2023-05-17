<?php

class Session {

    public function __construct() {
        session_start();
    }

    public function isLoggedIn() {
        return isset($_SESSION['email']);
    }

    public function loggout() {
        session_destroy();
    }

    public function getUsername() {
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }
    public function getUserUp() {
        return isset($_SESSION['up']) ? $_SESSION['up'] : null;
    }

    public function getEmail() {
        return isset($_SESSION['email']) ? $_SESSION['email'] : null;
    }
    public function get() {
        return isset($_SESSION['email']) ? $_SESSION['email'] : null;
    }

    public function getUserType() {
        return isset($_SESSION['userType']) ? $_SESSION['userType'] : null;
    }

    public function getDepartments() {
        return isset($_SESSION['departments']) ? $_SESSION['departments'] : null;
    }

    public function getDateOfRegister() {
        return isset($_SESSION['dateOfRegister']) ? $_SESSION['dateOfRegister'] : null;
    }

    public function getUserImg() {
        return isset($_SESSION['userImg']) ? $_SESSION['userImg'] : null;
    }

    public function getUp() {
        return isset($_SESSION['up']) ? $_SESSION['up'] : null;
    }

    public function setEmail($email) {
        $_SESSION['email'] = $email;
    }

    public function setUsername($username) {
        $_SESSION['username'] = $username;
    }

    public function setUserType($userType) {
        $_SESSION['userType'] = $userType;
    }
    public function setUserUp($up) {
        $_SESSION['up'] = $up;
    }

    public function setDepartments($departments) {
        $_SESSION['departments'] = $departments;
    }

    public function setDateOfRegister($dateOfRegister) {
        $_SESSION['dateOfRegister'] = $dateOfRegister;
    }

    public function setUserImg($userImg) {
        $_SESSION['userImg'] = $userImg;
    }

    public function setUp($up) {
        $_SESSION['up'] = $up;
    }

    public function isStudent() {
        return ($_SESSION['userType'] == "Student") ? true : false;
    }

    public function isStaff() {
        return ($_SESSION['userType'] == "Staff" || $_SESSION['userType'] == "Admin") ? true : false;
    }

    public function isAdmin() {
        return ($_SESSION['userType'] == "Admin") ? true : false;
    }

}

?>
