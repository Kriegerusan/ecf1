<?php
require_once 'nav.php';

require_once '../controller/ProductController.php';

$productCtrl = new ProductController();
$productCtrl->show_products();

if (isset($_GET)) {
    $productCtrl->add_product($_GET);
}
