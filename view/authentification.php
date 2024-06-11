<?php
require_once 'nav.php';
require_once '../controller/UserController.php';

require_once 'authentification_form.html';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userCtrl = new UserController();
    $userCtrl->authenticate($_POST['email'], $_POST['password']);
}
