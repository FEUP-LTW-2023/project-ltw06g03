<?php

class Status {
    public string $name;


    public function __construct(string $id)
    {
        $this->name=$id;
    }

    static function getStatus(PDO $db):array{
        $stmt = $db->prepare('SELECT NAME FROM STATUS ');
        $stmt->execute();

        $status_ = array();
        while ($status = $stmt->fetch()) {
            $status_[] = $status['NAME'];
        }

        return $status_;
    }

}
?>