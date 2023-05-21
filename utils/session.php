<?php

class Session {

    public function __construct() {
        session_start();
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = generate_random_token();
            session_set_cookie_params(0, '/', 'www.fe.up.pt', true, true);
        }
    }

    public function isLoggedIn() {
        return isset($_SESSION['up']);
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

    public function getRole() {
        return isset($_SESSION['role']) ? $_SESSION['role'] : null;
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

    public function setUserUp($up) {
        $_SESSION['up'] = $up;
    }

    public function setDepartments($departments) {
        $_SESSION['departments'] = $departments;
    }

    public function setRole($role) {
        $_SESSION['role'] = $role;
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
        return ($_SESSION['role'] == "Student") ? true : false;
    }

    public function isStaff() {
        return ($_SESSION['role'] == "Staff" || $_SESSION['role'] == "Admin") ? true : false;
    }

    public function isAdmin() {
        return ($_SESSION['role'] == "Admin") ? true : false;
    }

}

function generate_random_token() {
    return bin2hex(openssl_random_pseudo_bytes(32));
}

?>
