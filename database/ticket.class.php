<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');


class Ticket {
    public int $id;
    public string $title;
    public User $client;
    public string $status;
    public  string  $department;

    public function __construct(int $id, string $title,User $client,string $status,string $department)
    {
        $this->id = $id;
        $this->title = $title;
        $this->client = $client;
        $this->status=$status;
        $this->department=$department;
    }

    static function getTickets(PDO $db, int $up) : array {
        $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT FROM TICKET WHERE CLIENT_ID = ?');
        $stmt->execute(array($up));

        $tickets = array();
        while ($ticket = $stmt->fetch()) {
            $user = User::getUser($db, $up);
            $tickets[] = new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['DEPARTMENT']
            );
        }

        return $tickets;
    }

}
?>