<?php

class Department {
    public string $name;


    public function __construct(string $id)
    {
      $this->name=$id;
    }

    static function getUsersDepartments(PDO $db, int $up) : array {
        $stmt = $db->prepare('SELECT DEPARTMENT_ FROM WORKS_IN WHERE CLIENT_ID = ?');
        $stmt->execute(array($up));

        $departments = array();
        while ($department = $stmt->fetch()) {
            $departments[] = $department['DEPARTMENT_'];
        }

        return $departments;
    }
    static function getDepartments(PDO $db):array{
        $stmt = $db->prepare('SELECT NAME FROM DEPARTMENT ');
        $stmt->execute();

        $departments = array();
        while ($department = $stmt->fetch()) {
            $departments[] = $department['NAME'];
        }

        return $departments;
    }

}
?>