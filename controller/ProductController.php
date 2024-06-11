<?php
require_once '../model/Product.php';

class ProductController
{

    public function show_products()
    {
        $product = new Product();
        $products = $product->read();

        echo "
        <table class='table'>
            <thead>
                <th scope='col'>Nom</th>
                <th scope='col'>Prix</th>
            </thead>
            <tbody class='table-group-divider'>
        ";

        foreach ($products as $value) {
            echo "
                <tr>
                    <td scope='row'>" . $value['name'] . "</td>
                    <td>" . str_replace(".", ",", $value['price']) . " €</td>
                    <form>
                    <td><button class='btn btn-primary' name='article' value='" . $value['name'] . "," . $value['price'] . "'>Ajouter au panier</button></td>
                    </form>
                </tr>
            ";
        }

        echo "
        </tbody>
        </table>
        ";
    }

    //a deplacer a checkout
    public function add_product(array $productDetails)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        if ($productDetails != null) {
            $_SESSION['cart'][] = $productDetails;
        }
    }

    public function restock_product(int $id, int $quantity)
    {

        $datas = array(
            'stock' => $quantity
        );

        $product = new Product();
        $product->update($id, $datas);
    }

    public function show_management_product()
    {
        $product = new Product();

        $products = $product->read();

        foreach ($products as $value) {
            echo "
            <tr>
                <td>" . $value['id'] . "</td>
                <td>" . $value['name'] . "</td>
                <td>" . $value['price'] . " €</td>
                <td>" . $value['stock'] . "</td>
                <td>
                    <a href='?&id=" . $value['id'] . "'><button class='btn btn-primary' name=''>Gerer</button></a>
                </td>
            </tr>
            ";
        }
    }

    public function show_management_product_details($id)
    {
        $productInstance = new Product();

        $productDetails = $productInstance->get_product_info($id);


        echo "
            <thead>
                <th>" . $productDetails['id'] . "</th>
                <th>" . $productDetails['name'] . "</th>
                <th>" . $productDetails['price'] . "</th>
                <th>" . $productDetails['stock'] . "</th>
            </thead>
            <tbody class='table-group-divider'>
                <td></td>
                <td><input type='text' name='name' value='" . $productDetails['name'] . "'></td>
                <td><input type='text' name='price' value='" . $productDetails['price'] . "'></td>
                <td><input type='text' name='stock' value='" . $productDetails['stock'] . "'></td>
                <td><input type='hidden' name='id' value='" . $productDetails['id'] . "'><button class='btn btn-primary'>modifier</button></td>
            </tbody>
            ";
    }

    public function update_product($datas)
    {
        $product = new Product();
        $product->update($datas['id'],$datas);
    }
}
