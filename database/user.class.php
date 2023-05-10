<?php
declare(strict_types = 1);

class User {
    public int $up;
    public string $name;
    public string $email;

    public function __construct(int $up, string $name,string $email)
    {
        $this->up = $up;
        $this->name = $name;
        $this->email = $email;
    }
    public function getUp() : int
    {
        return $this->up;
    }
    static function getUser(PDO $db, int $id) : USER {
        $stmt = $db->prepare('SELECT UP, NAME,EMAIl FROM PERSON WHERE UP = ?');
        $stmt->execute(array($id));

        $user = $stmt->fetch();
        if(empty($user)) return new User(
            -1,
            '',
            ''
        );

        return new User(
            $user['UP'],
            $user['NAME'],
            $user['EMAIL'],
        );
    }

}
?>