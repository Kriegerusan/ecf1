<?php
require_once 'nav.php';
require_once '../controller/ProductController.php';

$productCtrl = new ProductController();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $productCtrl->update_product($_POST);
}

if($_GET == null){
?>


<table class=table>
    <thead>
        <th>id</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Stock</th>
    </thead>
    <tbody class='table-group-divider'>

    <?php $productCtrl->show_management_product(); ?>


    </tbody>
</table>


<?php
}else{
?>
<form action='' method='post'>
<table class=table>

    <?php $productCtrl->show_management_product_details($_GET['id']); ?>
    
</table>
</form>

<a href='product_management.php'><button class='btn btn-primary'>retour</button></a>


<?php } ?>