<?php
require_once 'Connection.php';

class Checkout extends Connection
{
    public function create($datas)
    {
        $pdo = Connection::connect();


        $fields = "";
        $values = "";

        foreach ($datas as $index => $value) {
            $fields .= ($fields ? ',' : "") . $index;
            if ($index == "products") {
                $values .= ($values ? ',' : '') . "'" . $value . "'";
            } else {
                $values .= ($values ? ',' : '') . $value;
            }
        }

        $req = $pdo->prepare(
            "INSERT INTO commande ($fields) VALUES ($values);"
        );

        if ($req->execute()) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['cart'] = null;
        }
    }

    public function get_order($id)
    {
        $pdo = Connection::connect();

        $req = $pdo->query(
            "SELECT * FROM commande WHERE id_user = $id;"
        );

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
