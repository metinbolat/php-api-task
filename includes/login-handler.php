<?php

use classes\Login;

require_once __DIR__ . '/../classes/Login.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = new Login($_POST['username'], $_POST['password']);
    if (!isset($_SESSION['access_token'])) {
        echo 'Die!';
    }
    header('Location: ../index.php');
}
