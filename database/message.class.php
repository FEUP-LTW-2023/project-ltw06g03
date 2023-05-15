<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');


class Message {
    public int $ticketId;
    public string $text;
    public User $client;


    public function __construct(int $id,string $text, User $client)
    {
        $this->ticketId=$id;
        $this->text=$text;
        $this->client=$client;
    }

    static function getTicketMessages(PDO $db, int $id) : array {
        $stmt = $db->prepare('SELECT TICKET_ID, TEXT,PERSON_ID FROM TICKET_MESSAGE WHERE TICKET_ID = ?');
        $stmt->execute(array($id));

        $messages = array();
        while ($message = $stmt->fetch()) {
            $user = User::getUser($db, $message['PERSON_ID']);
            $messages[] = new Message(
                $message['TICKET_ID'],
                $message['TEXT'],
                $user
            );
        }

        return $messages;
    }

}
?>