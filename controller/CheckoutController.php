<?php
require_once '../model/Checkout.php';

class CheckoutController
{

    private float $totalPrice = 0;
    private int $totalArticle = 0;

    public function show_cart()
    {

        foreach($_SESSION['cart'] as $value){
            //var_dump($value);

            $articleDetails = explode("," , $value['article']);
            $this->totalArticle++; 
            $this->totalPrice += $articleDetails[1];
            echo"
                <tr>
                    <td>". $articleDetails[0] ."</td>
                    <td>". str_replace("." , "," , $articleDetails[1]) ." €</td>
                </tr>
            ";


        }
    }

    public function get_totalPrice()
    {
        return str_replace("." , "," , $this->totalPrice);
    }

    public function get_totalArticle()
    {
        return $this->totalArticle;
    }

    public function validate_checkout($price, $articles)
    {
        $products = "";

        foreach($_SESSION['cart'] as $value)
        {
            $articleDetails = explode(",", $value['article']);

            $products .= ($products? "," : "") . $articleDetails[0];
        }

        $datas = array(
            'id_user' => $_SESSION['user']['id'],
            'products' => $products,
            'total_price' => str_replace(",", "." , $price),
            'nb_products' => $articles
        );

        $checkout = new Checkout();
        $checkout->create($datas);
        // echo $products;
        // var_dump($_SESSION['user']);
    }

    public function get_order_by_user()
    {
        $checkout = new Checkout();
        return $checkout->get_order($_SESSION['user']['id']);

    }

    public function show_orders()
    {
        $orders = $this->get_order_by_user();
        foreach($orders as $value){
            echo "
                <tr>
                    <td>" . $value['id'] . "</td>
                    <td>" . $value['date'] . "</td>
                    <td>" . $value['total_price'] . " €</td>
                    <td>" . $value['nb_products'] . "</td>
                </tr>
            ";
        }
        
    }
}