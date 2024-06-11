<?php
require_once 'nav.php';


require_once '../controller/UserController.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $userCtrl = new UserController();
    $userCtrl->create($_POST);
}

require_once 'register_form.html';

