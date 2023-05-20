<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');


class Doubts {
    public int $id;
    public string $text;



    public function __construct(int $id,string $text)
    {
       $this->id=$id;
       $this->text=$text;
    }

    static function getDoubts(PDO $db) : array {
        $stmt = $db->prepare('SELECT ID, TEXT FROM DOUBTS ORDER BY ID DESC ');
        $stmt->execute();

        $doubts = array();
        while ($doubt = $stmt->fetch()) {

            $doubts[] = new Doubts(
                $doubt['ID'],
                $doubt['TEXT'],
            );
        }

        return $doubts;
    }
    function new(PDO $db){
        $stmt = $db->prepare('INSERT INTO DOUBTS(TEXT) values (?)');
        $stmt->execute(array($this->text));
    }

}
?>