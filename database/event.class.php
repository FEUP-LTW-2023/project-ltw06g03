<?php

declare(strict_types = 1);
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/message.class.php');


class Event
{
    public int $id;
    public string $description;
    public User $user;
    public string $date;

    public function __construct(int $id, string $description, User $user, string $date)
    {
        $this->id = $id;
        $this->description = $description;
        $this->user = $user;
        $this->date = $date;
    }

    static function getTicketEvents(PDO $db, int $id): array
    {
        $stmt = $db->prepare('SELECT EVENT_ID, CLIENT_ID,DESCRIPTION,CREATED_AT FROM EVENT WHERE TICKET_ID = ? ORDER BY CREATED_AT ASC ');
        $stmt->execute(array($id));
        $events = array();
        while ($event = $stmt->fetch()) {
            $user = User::getUser($db, $event['CLIENT_ID']);
            $events[] = new Event(
                $event['EVENT_ID'],
                $event['DESCRIPTION'],
                $user,
                $event['CREATED_AT'],

            );
        }

        return $events;
    }
}
?>