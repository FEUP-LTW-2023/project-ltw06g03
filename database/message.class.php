<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');


class Message {
    public int $ticketId;
    public string $text;
    public User $client;


    public function __construct(int $id, string $title,User $client,string $status,string $department,string $problem)
    {
        $this->id = $id;
        $this->title = $title;
        $this->client = $client;
        $this->status=$status;
        $this->department=$department;
        $this->problem=$problem;
    }

    static function getTickets(PDO $db, int $up) : array {
        $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBELM FROM TICKET WHERE CLIENT_ID = ?');
        $stmt->execute(array($up));

        $tickets = array();
        while ($ticket = $stmt->fetch()) {
            $user = User::getUser($db, $up);
            $tickets[] = new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['DEPARTMENT'],
                $ticket['PROBLEM']
            );
        }

        return $tickets;
    }

}
?>