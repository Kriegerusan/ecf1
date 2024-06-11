<?php

require_once 'Connection.php';
class User extends Connection
{

    public function get_user(string $email)
    {

        $pdo = Connection::connect();
        $req = $pdo->prepare(
            "SELECT * FROM utilisateur WHERE email = :email;"
        );
        $req->bindValue(':email', $email);

        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function create_user(array $datas)
    {
        $pdo = Connection::connect();

        $fields = "";
        $values = "";

        foreach ($datas as $index => $value) {
            $fields .= ($fields ? ',' : "") . $index;
            $values .= ($values ? ',' : '') . '"' .  "$value" . '"';
        }

        $req = $pdo->prepare(
            "INSERT INTO utilisateur ($fields) VALUES ($values);"
        );


        $req->execute();
    }
}
