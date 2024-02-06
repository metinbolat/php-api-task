<?php

use classes\Login;

require_once __DIR__ . '/../classes/Login.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = new Login($_POST['username'], $_POST['password']);
    header('Location: ../index.php');
}
