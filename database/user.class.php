<?php
declare(strict_types = 1);

class User {
    public int $up;
    public string $name;
    public string $email;
    public string $role;
    public  string  $pass;

    public function __construct(int $up, string $name,string $email,string $role,string $pass)
    {
        $this->up = $up;
        $this->name = $name;
        $this->email = $email;
        $this->role=$role;
        $this->pass=$pass;
    }

    public function getUp() : int
    {
        return $this->up;
    }
    
    static function getUser(PDO $db, int $id) : USER {
        $stmt = $db->prepare('SELECT UP, NAME,EMAIl,ROLE,PASSWORD FROM PERSON WHERE UP = ?');
        $stmt->execute(array($id));

        $user = $stmt->fetch();
        if(empty($user)) return new User(
            -1,
            '',
            '',
            '',
            '',
        );

        return new User(
            $user['UP'],
            $user['NAME'],
            $user['EMAIL'],
            $user['ROLE'],
            $user['PASSWORD']
        );
    }

    static function getUsers(PDO $db) : array {
        $stmt = $db->prepare('SELECT UP, NAME, EMAIL, ROLE, PASSWORD FROM PERSON');
        $stmt->execute();

        $ret = array();

        while($user = $stmt->fetch()) {
            $ret[] = new User(
                $user['UP'],
                $user['NAME'],
                $user['EMAIL'],
                $user['ROLE'],
                $user['PASSWORD']
            );
        }

        return $ret;
    }


    static function searchUser(PDO $db, string $nameOrUP) : array {
        $stmt = $db->prepare('SELECT UP, NAME, EMAIL, ROLE, PASSWORD FROM PERSON WHERE NAME LIKE ? OR UP LIKE ?');

        try {
            $stmt->execute(array($nameOrUP . '%',  intval($nameOrUP) . '%'));
        }
        catch(Exception $e) {
            $stmt->execute(array($nameOrUP . '%',  -1 . '%'));
        }

        $ret = array();

        while($user = $stmt->fetch()) {
            $ret[] = new User(
                $user['UP'],
                $user['NAME'],
                $user['EMAIL'],
                $user['ROLE'],
                $user['PASSWORD']
            );
        }

        return $ret;
    }

}
?>