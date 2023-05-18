<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/message.class.php');


class Ticket {
    public int $id;
    public string $title;
    public User $client;
    public string $status;
    public  string  $department;
    public string $problem;
    public array $messages;

    public function __construct(int $id, string $title,User $client,string $status,string $problem, array  $messages)
    {
        $this->id = $id;
        $this->title = $title;
        $this->client = $client;
        $this->status=$status;
        $this->problem=$problem;
        $this->messages=$messages;
    }

    static function getUserTickets(PDO $db, int $up) : array {
        $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET WHERE CLIENT_ID = ?');
        $stmt->execute(array($up));

        $tickets = array();
        while ($ticket = $stmt->fetch()) {
            $user = User::getUser($db, $up);
            $messages= Message::getTicketMessages($db,$ticket['ID']);
            $tickets[] = new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['PROBLEM'],
                $messages
            );
        }

        return $tickets;
    }
    static function getTickets(PDO $db, string $search) : array {

            if(is_numeric($search))$up=intval($search);
            else $up=-1;
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET JOIN PERSON ON (CLIENT_ID==UP)  WHERE UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ? LIMIT 10');
            $stmt->execute(array($up . '%', $search . '%',$search . '%'));

        $tickets = array();
        while ($ticket = $stmt->fetch()) {
            $user = User::getUser($db, $ticket['CLIENT_ID']);
            $messages= Message::getTicketMessages($db,$ticket['ID']);
            $tickets[] = new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['PROBLEM'],
                $messages
            );
        }

        return $tickets;
    }

}
?>