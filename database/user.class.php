<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../database/department.class.php');


class User {
    public int $up;
    public string $name;
    public string $email;
    public string $role;
    public  string  $pass;
    public string $img;
    public array $departments;

    public function __construct(int $up, string $name,string $email,string $role,string $pass,string $img,array $departments)
    {
        $this->up = $up;
        $this->name = $name;
        $this->email = $email;
        $this->role=$role;
        $this->pass=$pass;
        $this->img=$img;
        $this->departments=$departments;
    }
    
    static function getUser(PDO $db, int $id) : USER {
        $stmt = $db->prepare('SELECT UP, NAME,EMAIl,ROLE,PASSWORD,IMG FROM PERSON WHERE UP = ?');
        $stmt->execute(array($id));

        $user = $stmt->fetch();
        if(empty($user)) return new User(
            -1,
            '',
            '',
            '',
            '',
            '',
            []
        );

        $img=$user['IMG'];
        if(!isset($img) or !file_exists($img)) {
            $img='/docs/images/default_pfp.png' ;
        }

        $departments=Department::getUsersDepartments($db, $user['UP']);

        return new User(
            $user['UP'],
            $user['NAME'],
            $user['EMAIL'],
            $user['ROLE'],
            $user['PASSWORD'],
            $img,
            $departments
        );
    }

    function delete(PDO $db) {
        $stmt = $db->prepare('
        DELETE FROM PERSON WHERE UP = ?
      ');

        $stmt->execute(array($this->up));
    }

    function save(PDO $db) {
        $stmt = $db->prepare('

        UPDATE PERSON SET NAME = ?, EMAIL = ?, ROLE= ?, PASSWORD= ?,IMG=?
        WHERE UP = ?
      ');
        $stmt->execute(array($this->name, $this->email, $this->role, $this->pass, $this->img,$this->up));
    }



    function uploadImg(PDO $db,string $img){
        $stmt = $db->prepare('
        UPDATE PERSON SET  IMG= ?
        WHERE UP = ?
      ');

        $stmt->execute(array($img,$this->up));
    }
    static function getUsersAssign(PDO $db, int $id,string $search) : array
    {
        $up=-1;
        if(is_numeric($search))$up=$search;
        $stmt = $db->prepare('SELECT PERSON.UP, NAME,EMAIl,ROLE,PASSWORD,IMG FROM PERSON JOIN ASSIGN ON PERSON.UP==ASSIGN.UP WHERE TICKET_ID = ? AND(PERSON.UP LIKE ? OR NAME LIKE ? )');
        $stmt->execute(array($id,$up . '%', '%' . $search . '%' ));
        $users = array();
        while ($user = $stmt->fetch()) {
            $img = $user['IMG'];
            if (!isset($img) or !file_exists($img)) {
                $img = '/docs/images/default_pfp.png';
            }
            $departments = Department::getUsersDepartments($db, $user['UP']);
            $users[] = new User(
                $user['UP'],
                $user['NAME'],
                $user['EMAIL'],
                $user['ROLE'],
                $user['PASSWORD'],
                $img,
                $departments
            );
        }
        return $users;
    }
    static function getUsersNotAssign(PDO $db, int $id,string $search) : array
    {
        $up=-1;
        if(is_numeric($search))$up=$search;
        $stmt = $db->prepare('SELECT PERSON.UP, NAME,EMAIl,ROLE,PASSWORD,IMG FROM PERSON  WHERE UP NOT IN (select PERSON.UP FROM PERSON JOIN ASSIGN ON ASSIGN.UP==PERSON.UP WHERE TICKET_ID= ?)AND ( ROLE=? or ROLE=?) AND(PERSON.UP LIKE ? OR NAME LIKE ? )');
        $stmt->execute(array($id,'Admin','Staff',$up .'%','%'. $search .'%'));
        $users = array();
        while ($user = $stmt->fetch()) {
            $img = $user['IMG'];
            if (!isset($img) or !file_exists($img)) {
                $img = '/docs/images/default_pfp.png';
            }
            $departments = Department::getUsersDepartments($db, $user['UP']);
            $users[] = new User(
                $user['UP'],
                $user['NAME'],
                $user['EMAIL'],
                $user['ROLE'],
                $user['PASSWORD'],
                $img,
                $departments
            );
        }
        return $users;
    }

    static function getUsers(PDO $db) : array {
        $stmt = $db->prepare('SELECT UP, NAME, EMAIL, ROLE, PASSWORD, IMG FROM PERSON');
        $stmt->execute();

        $ret = array();


        while($user = $stmt->fetch()) {

            $img='../docs/feup.png';
            if($user['IMG']!=null) $img="data:image/png;base64," . $user['IMG'] ;
            $departments=Department::getUsersDepartments($db, $user['UP']);

            $ret[] = new User(
                $user['UP'],
                $user['NAME'],
                $user['EMAIL'],
                $user['ROLE'],
                $user['PASSWORD'],
                $img,
                $departments
            );
        }

        return $ret;
    }


    static function searchUser(PDO $db, string $nameOrUP) : array {
        $stmt = $db->prepare('SELECT UP, NAME, EMAIL, ROLE, PASSWORD, IMG FROM PERSON WHERE NAME LIKE ? OR UP LIKE ?');



        if (is_numeric($nameOrUP)) {
            $nameOrUP = intval($nameOrUP);
            $stmt->execute(array('',  $nameOrUP . '%'));
        }
        else {
            $stmt->execute(array('%'. $nameOrUP .'%',  -1 ));
        }

        $ret = array();

        while($user = $stmt->fetch()) {

            $img='../docs/feup.png';
            if($user['IMG']!=null) $img="data:image/png;base64," . $user['IMG'] ;
            $departments=Department::getUsersDepartments($db, $user['UP']);

            $ret[] = new User(
                $user['UP'],
                $user['NAME'],
                $user['EMAIL'],
                $user['ROLE'],
                $user['PASSWORD'],
                $img,
                $departments
            );
        }

        return $ret;
    }

}

?>