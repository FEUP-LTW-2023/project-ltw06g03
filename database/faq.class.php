<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');


class FAQ {

    public string $title;
    public string $text;



    public function __construct(string $title,string $text)
    {

        $this->title=$title;
        $this->text=$text;
    }

    static function getFaqs(PDO $db) : array {


        $stmt = $db->prepare('SELECT  TITLE,TEXT FROM FAQ  ');
        $stmt->execute();

        $faqs = array();
        while ($faq = $stmt->fetch()) {
            $faqs[] = new FAQ(
                $faq['TITLE'],
                $faq['TEXT']
            );
        }

        return $faqs;
    }
    function new(PDO $db){
        $stmt = $db->prepare('INSERT INTO FAQ(TITLE,TEXT) values (?,?)');
        $stmt->execute(array($this->title,$this->text));
    }
}
?>