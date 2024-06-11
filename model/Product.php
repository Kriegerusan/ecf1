<?php
require_once 'Connection.php';
require_once 'iCRUD.php';

class Product extends Connection implements iCRUD
{
    public function read()
    {
        $pdo = Connection::connect();
        $req = $pdo->query(
            "SELECT * FROM produit;"
        );

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($datas)
    {
        $pdo = Connection::connect();
        $req = $pdo->prepare(
            "INSERT INTO "
        );
    }

    public function update($id, $newDatas)
    {
        $fields = "";

        foreach ($newDatas as $index => $value) {
            if ($index == 'name') {
                $fields .= ($fields ? "," : "") . $index . "= '" . $value . "'";
            } else {
                if ($index != "id") {
                    $fields .= ($fields ? "," : "") . $index . "=" . $value;
                }
            }
        }

        $pdo = Connection::connect();

        $req = $pdo->prepare(
            "UPDATE produit SET " . $fields . " WHERE produit.id = $id;"
        );

        $req->execute();
    }

    public function get_product_info($id)
    {
        $pdo = Connection::connect();
        $req = $pdo->prepare(
            "SELECT * FROM produit WHERE produit.id = :id;"
        );

        $req->bindValue(":id", $id, PDO::PARAM_INT);

        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC);
    }
}
