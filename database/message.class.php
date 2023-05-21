<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');


class Message {
    public int $ticketId;
    public string $text;
    public User $client;
    public string $date;


    public function __construct(int $id,string $text, User $client,string $date)
    {
        $this->ticketId=$id;
        $this->text=$text;
        $this->client=$client;
        $this->date=$date;
    }

    static function getTicketMessages(PDO $db, int $id) : array {
        $stmt = $db->prepare('SELECT TICKET_ID, TEXT,PERSON_ID,CREATED_AT FROM TICKET_MESSAGE WHERE TICKET_ID = ? ORDER BY CREATED_AT ASC ');
        $stmt->execute(array($id));

        $messages = array();
        while ($message = $stmt->fetch()) {
            $user = User::getUser($db, $message['PERSON_ID']);
            $messages[] = new Message(
                $message['TICKET_ID'],
                $message['TEXT'],
                $user,
                $message['CREATED_AT']
            );
        }

        return $messages;
    }
    static  function new(PDO $dbh,string $text,int $id, int $up){
        $stmt = $dbh->prepare('INSERT INTO TICKET_MESSAGE (TEXT, TICKET_ID,PERSON_ID) VALUES (?, ?,?)');
        $stmt->execute(array($text,$id,$up));
    }

}
?>