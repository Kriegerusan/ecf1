<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ECF1</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<?php session_start(); ?>

<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href='product.php'>Produits</a>
      <a class="navbar-brand" href='checkout.php'>Panier</a>

      <?php if (!isset($_SESSION['user'])) { ?>
        <div>
          <a class="navbar-brand" href='authentification.php'>Se connecter</a>
          <a class="navbar-brand" href='register.php'>S'incrire</a>
        </div>
      <?php } else { ?>
        <a class="navbar-brand" href='orders.php'>Commandes</a>
        <a class="navbar-brand" href='disconnect.php'><button class='btn btn-danger'>Se deconnecter</button></a>
      <?php } ?>

    </div>
  </nav>

  <?php if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['privileges'] == "admin") {
      require_once 'nav_admin.html';
    }
  } ?>
</header>