<?php

class Connection
{
    public function connect()
    {
        $pdo = new PDO("mysql:host=localhost;dbname=commerce", "root", "");
        return $pdo;
    }
}
