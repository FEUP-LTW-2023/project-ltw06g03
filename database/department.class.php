<?php

class Department {
    public string $name;


    public function __construct(string $id)
    {
      $this->name=$id;
    }

    function new(PDO $db) {
        $stmt = $db->prepare('
        INSERT INTO DEPARTMENT (NAME)
        VALUES (?)
      ');

        $stmt->execute(array($this->name));
    }

    function delete(PDO $db) {
        $stmt = $db->prepare('
        DELETE FROM DEPARTMENT WHERE NAME = ?
      ');

        $stmt->execute(array($this->name));
    }

    function changeUserDepartment(PDO $db, int $up, string $action) {
      if ($action == 'INSERT') {
        $stmt = $db->prepare('
          INSERT INTO WORKS_IN (DEPARTMENT_, CLIENT_ID)
          VALUES (?, ?)
        ');
      } elseif ($action == 'DELETE') {
        $stmt = $db->prepare('
          DELETE FROM WORKS_IN WHERE DEPARTMENT_ = ? AND CLIENT_ID = ?
        ');
      }

      $stmt->execute(array($this->name, $up));
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

    static function getAllDepartments(PDO $db) : array {
        $stmt = $db->prepare('SELECT NAME FROM DEPARTMENT');
        $stmt->execute();

        $departments = array();
        while ($department = $stmt->fetch()) {
            $departments[] = new Department($department['NAME']);
        }

        return $departments;
    }

    static function getDepartment(PDO $db, string $name) : Department {
        $stmt = $db->prepare('SELECT NAME FROM DEPARTMENT WHERE NAME = ?');
        $stmt->execute(array($name));

        $department = $stmt->fetch();

        return new Department($department['NAME']);
    }

}
?>