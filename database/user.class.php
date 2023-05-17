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
        $img='../docs/images/default_pfp.png';
        if($user['IMG']!=null) $img="data:image/png;base64," . $user['IMG'] ;
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
    function save(PDO $db) {
        $stmt = $db->prepare('
        UPDATE PERSON SET NAME = ?, EMAIL = ?, PASSWORD= ?
        WHERE UP = ?
      ');

        $stmt->execute(array($this->name, $this->email, $this->pass,$this->up));
    }
    function uploadImg(PDO $db,string $img){
        $stmt = $db->prepare('
        UPDATE PERSON SET  IMG= ?
        WHERE UP = ?
      ');

        $stmt->execute(array($img,$this->up));
    }

}

?>