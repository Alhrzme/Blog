<?php

namespace application\additionally;

class Connection
{
    private static $opt = array(
        \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
    );

    public static function getConnection ()
    {
        return $connection = new \PDO('mysql:host=127.0.0.1;dbname=example_db;charset=UTF8', 'root', 44834631, self::$opt);
    }
}