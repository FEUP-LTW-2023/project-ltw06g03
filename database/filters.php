<?php 
    declare(strict_types=1);

    function encode_string(string $string): string{
        $string = preg_replace ("/[^a-zA-Z\s]/", '', $string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    function encode_int(string $int): int {
        $int = preg_replace ("/[^0-9\s]/", '', $int);
        $int = stripslashes($int);
        $int = htmlspecialchars($int);
        $int = intval($int);
        return $int;
    }


?>