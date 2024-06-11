<?php
require_once 'nav.php';
require_once '../controller/CheckoutController.php';

$cart = new CheckoutController();

if (isset($_GET['clearCart']) && isset($_SESSION['cart'])) {
    $_SESSION['cart'] = null;
}
if (isset($_GET['checkout']) && isset($_SESSION['cart'])) {
    $cart->validate_checkout($_GET['totalPrice'], $_GET['totalArticle']);
}

?>
<table class="table">
    <thead>
        <th scope="col">Article</th>
        <th scope="col">Prix</th>
    </thead>
    <tbody class='table-group-divider'>
        <?php if (isset($_SESSION['cart'])) {
            $cart->show_cart();
        } else {
            "";
        } ?>
    </tbody>
    <tfoot class='table-group-divider'>
        <tr>
            <th>Total :</th>
            <th><?php echo $cart->get_totalPrice() ?> €</th>
        </tr>
        <tr>
            <th>Nombre d'article :</th>
            <td><?php echo $cart->get_totalArticle() ?></td>
        </tr>


    </tfoot>

</table>
<form>
    <input type='hidden' name='totalPrice' value='<?php echo $cart->get_totalPrice() ?>'>
    <input type='hidden' name='totalArticle' value='<?php echo $cart->get_totalArticle() ?>'>
    <button name='clearCart' class='btn btn-danger'>Effacer Panier</button>
    <button name='checkout' class='btn btn-success' <?php if (!isset($_SESSION['user'])) {
                                                        echo "disabled";
                                                    } else {
                                                        "";
                                                    } ?>>Valider Panier</button>

</form>
<?php if (!isset($_SESSION['user'])) {
    echo "Veuillez vous connecter ou creer un compte pour valider votre commande.";
} else {
    "";
} ?>