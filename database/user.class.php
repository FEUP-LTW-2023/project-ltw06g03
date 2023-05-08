<?php
declare(strict_types = 1);

class User {
    public int $up;
    public string $name;
    public string $email;

    public function __construct(int $up, string $name,string $email)
    {
        $this->up = $up;
        $this->name = $name;
        $this->email = $email;
    }
    public function getUp() : int
    {
        return $this->up;
    }


    /* static function getUser(PDO $db, int $count) : array {
         $stmt = $db->prepare('SELECT UP, Email FROM PERSON LIMIT ?');
         $stmt->execute(array($count));

         $artists = array();
         while ($artist = $stmt->fetch()) {
             $artists[] = new Artist(
                 $artist['ArtistId'],
                 $artist['Name']
             );
         }

         return $artists;
     }*/

   /* static function searchArtists(PDO $db, string $search, int $count) : array {
        $stmt = $db->prepare('SELECT ArtistId, Name FROM Artist WHERE Name LIKE ? LIMIT ?');
        $stmt->execute(array($search . '%', $count));

        $artists = array();
        while ($artist = $stmt->fetch()) {
            $artists[] = new Artist(
                $artist['ArtistId'],
                $artist['Name']
            );
        }

        return $artists;
    }*/


    static function getUser(PDO $db, int $id) : USER {
        $stmt = $db->prepare('SELECT UP, NAME,EMAIl FROM PERSON WHERE UP = ?');
        $stmt->execute(array($id));

        $user = $stmt->fetch();
        if(empty($user)) return new User(
            -1,
            '',
            ''
        );

        return new User(
            $user['UP'],
            $user['NAME'],
            $user['EMAIL'],
        );
    }

}
?>