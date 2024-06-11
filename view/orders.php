<?php
require_once 'nav.php';

require_once '../controller/CheckoutController.php';


$checkoutCtrl = new CheckoutController();



?>

<table class="table">
    <thead>
        <th scope='col'>Id Commande</th>
        <th scope='col'>Date</th>
        <th scope='col'>Prix Total</th>
        <th scope='col'>Nombre de produit</th>
    </thead>
    <tbody class="table-group-divider">
        <?php $checkoutCtrl->show_orders(); ?>
    </tbody>
</table>