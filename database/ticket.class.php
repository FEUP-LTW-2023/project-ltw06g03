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

    static function getUserTickets(PDO $db, int $up, string $search,string $status,string $department) : array {
        if($department==='')$department='%';
        if($status==='') {
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET WHERE CLIENT_ID = ? AND TITLE LIKE ? AND DEPARTMENT LIKE ? ORDER BY CREATED_AT DESC LIMIT 100');
            $stmt->execute(array($up, '%' . $search . '%',$department));
        }
        else{
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET WHERE CLIENT_ID = ? AND STATUS= ? AND TITLE LIKE ? AND DEPARTMENT LIKE ? ORDER BY CREATED_AT DESC LIMIT 100');
            $stmt->execute(array($up, $status,'%' . $search . '%',$department));
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


    static function getTickets(PDO $db, string $search,string $status,string $department) : array {
            if($department==='') $department='%';
            if(is_numeric($search))$up=intval($search);
            else $up=-1;
            if($status==='') {
                $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET JOIN PERSON ON (CLIENT_ID==UP)  WHERE (UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ?) and DEPARTMENT LIKE ? ORDER BY TICKET.CREATED_AT DESC LIMIT 100 ');
                $stmt->execute(array($up . '%', '%' . $search . '%', '%' . $search . '%',$department ));
            }
            else{
                $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM TICKET JOIN PERSON ON (CLIENT_ID==UP)  WHERE STATUS== ? AND (UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ?) and DEPARTMENT LIKE ? ORDER BY TICKET.CREATED_AT DESC LIMIT 100 ');
                $stmt->execute(array($status,$up . '%', '%' . $search . '%', '%' . $search . '%',$department));
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

    static function getAssignTickets(PDO $db, int $up,string $search,string $status,string $department) : array {
        if($department==='') $department='%';
        if(is_numeric($search))$up_=intval($search);
        else $up_=-1;
        if($status==='') {
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM (ASSIGN JOIN TICKET ON (TICKET_ID==ID)) JOIN PERSON ON (CLIENT_ID==PERSON.UP)  WHERE ASSIGN.UP== ? AND (PERSON.UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ?) AND DEPARTMENT LIKE ? ORDER BY TICKET.CREATED_AT DESC LIMIT 100 ');
            $stmt->execute(array($up,$up_ . '%', '%' . $search . '%', '%' . $search . '%',$department));
        }
        else{
            $stmt = $db->prepare('SELECT ID, TITLE,CLIENT_ID,STATUS,DEPARTMENT,PROBLEM FROM (ASSIGN JOIN TICKET ON (TICKET_ID==ID)) JOIN PERSON ON (CLIENT_ID==PERSON.UP)  WHERE ASSIGN.UP== ? AND STATUS== ? AND (PERSON.UP LIKE ? OR NAME LIKE ? OR TITLE LIKE ?) AND DEPARTMENT LIKE ? ORDER BY TICKET.CREATED_AT DESC LIMIT 100 ');
            $stmt->execute(array($up,$status,$up_ . '%', '%' . $search . '%', '%' . $search . '%',$department));
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
    static  function assign(PDO $dbh,int $id,int $up){
        $stmt = $dbh->prepare('INSERT INTO ASSIGN (UP, TICKET_ID) VALUES (?, ?)');
        $stmt->execute(array($up,$id));
    }
    static  function discharged(PDO $dbh,int $id,int $up){
        $stmt = $dbh->prepare('DELETE FROM ASSIGN WHERE UP==? AND TICKET_ID==?');
        $stmt->execute(array($up,$id));
    }
    static  function new(PDO $dbh,string $title,string $problem, int $up, string $department){
        $stmt = $dbh->prepare('INSERT INTO TICKET (TITLE, PROBLEM,CLIENT_ID,DEPARTMENT) VALUES (?, ?,?,?)');
        $stmt->execute(array($title,$problem,$up, $department));
    }


}
?>