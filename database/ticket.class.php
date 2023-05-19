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
    public array $assigns;

    public function __construct(int $id, string $title,User $client,string $status,string $problem, array  $messages,string $department,array $assign)
    {
        $this->id = $id;
        $this->title = $title;
        $this->client = $client;
        $this->status=$status;
        $this->problem=$problem;
        $this->messages=$messages;
        $this->department=$department;
        $this->assigns=$assign;
    }

    static function getUserTickets(PDO $db, int $up, string $search,string $status) : array {
        if($status==='') {
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET WHERE CLIENT_ID = ? AND TITLE LIKE ? ORDER BY ID DESC LIMIT 100');
            $stmt->execute(array($up, '%' . $search . '%'));
        }
        else{
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET WHERE CLIENT_ID = ? AND STATUS= ? AND TITLE LIKE ? ORDER BY ID DESC LIMIT 100');
            $stmt->execute(array($up, $status,'%' . $search . '%'));
        }
        $tickets = array();
        while ($ticket = $stmt->fetch()) {
            $user = User::getUser($db, $up);
            $assigns= User::getUsersAssign($db,$ticket['ID'],'');
            $messages= Message::getTicketMessages($db,$ticket['ID']);
            $tickets[] = new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['PROBLEM'],
                $messages,
                $ticket['DEPARTMENT'],
                $assigns
            );
        }

        return $tickets;
    }


    static function getTickets(PDO $db, string $search,string $status) : array {
            if(is_numeric($search))$up=intval($search);
            else $up=-1;
            if($status==='') {
                $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET JOIN PERSON ON (CLIENT_ID==UP)  WHERE UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ? ORDER BY ID DESC LIMIT 100 ');
                $stmt->execute(array($up . '%', '%' . $search . '%', '%' . $search . '%'));
            }
            else{
                $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET JOIN PERSON ON (CLIENT_ID==UP)  WHERE STATUS== ? AND (UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ?) ORDER BY ID DESC LIMIT 100 ');
                $stmt->execute(array($status,$up . '%', '%' . $search . '%', '%' . $search . '%'));
            }
        $tickets = array();
        while ($ticket = $stmt->fetch()) {
            $user = User::getUser($db, $ticket['CLIENT_ID']);
            $messages= Message::getTicketMessages($db,$ticket['ID']);
            $assigns= User::getUsersAssign($db,$ticket['ID'],'');
            $tickets[] = new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['PROBLEM'],
                $messages,
                $ticket['DEPARTMENT'],
                $assigns
            );
        }

        return $tickets;
    }
    static function getTicket(PDO $db, int $id) : ?Ticket {

        $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET WHERE ID=?');
        $stmt->execute(array($id));
        $ticket = $stmt->fetch();
        if(!isset($ticket)) return null;

            $user = User::getUser($db, $ticket['CLIENT_ID']);
            $messages= Message::getTicketMessages($db,$ticket['ID']);
            $assigns= User::getUsersAssign($db,$ticket['ID'],'');
            return new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['PROBLEM'],
                $messages,
                $ticket['DEPARTMENT'],
                $assigns
            );

    }

    static function getAssignTickets(PDO $db, int $up,string $search,string $status) : array {
        if(is_numeric($search))$up_=intval($search);
        else $up_=-1;
        if($status==='') {
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM (ASSIGN JOIN TICKET ON (TICKET_ID==ID)) JOIN PERSON ON (CLIENT_ID==PERSON.UP)  WHERE ASSIGN.UP== ? AND (PERSON.UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ?) ORDER BY ID DESC LIMIT 100 ');
            $stmt->execute(array($up,$up_ . '%', '%' . $search . '%', '%' . $search . '%'));
        }
        else{
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM (ASSIGN JOIN TICKET ON (TICKET_ID==ID)) JOIN PERSON ON (CLIENT_ID==PERSON.UP)  WHERE ASSIGN.UP== ? AND STATUS== ? AND (PERSON.UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ?) ORDER BY ID DESC LIMIT 100 ');
            $stmt->execute(array($up,$status,$up_ . '%', '%' . $search . '%', '%' . $search . '%'));
        }
        $tickets = array();
        while ($ticket = $stmt->fetch()) {
            $user = User::getUser($db, $ticket['CLIENT_ID']);
            $messages= Message::getTicketMessages($db,$ticket['ID']);
            $assigns= User::getUsersAssign($db,$ticket['ID'],'');
            $tickets[] = new Ticket(
                $ticket['ID'],
                $ticket['TITLE'],
                $user,
                $ticket['STATUS'],
                $ticket['PROBLEM'],
                $messages,
                $ticket['DEPARTMENT'],
                $assigns
            );
        }
        return $tickets;
    }
    function save(PDO $db) {
        $stmt = $db->prepare('
        UPDATE TICKET SET STATUS = ?, DEPARTMENT = ?
        WHERE id = ?
      ');

        $stmt->execute(array($this->status, $this->department, $this->id));
    }


}
?>