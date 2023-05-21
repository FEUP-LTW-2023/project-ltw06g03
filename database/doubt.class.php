<?php

declare(strict_types = 1);



class Doubt{
    public string $text;



    public function __construct(string $text)
    {

       $this->text=$text;
    }

    static function getDoubts(PDO $db) : array {
        $stmt = $db->prepare('SELECT ID, TEXT FROM DOUBT ORDER BY ID DESC ');
        $stmt->execute();

        $doubts = array();
        while ($doubt = $stmt->fetch()) {

            $doubts[] = new Doubt(
                $doubt['TEXT'],
            );
        }

        return $doubts;
    }
    function new(PDO $db){
        $stmt = $db->prepare('INSERT INTO DOUBT(TEXT) values (?)');
        $stmt->execute(array($this->text));
    }

}
?>