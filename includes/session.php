<?php
session_start();
if (
    empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
) {
    if (
        !isset($_SESSION['access_token'])
        || !isset($_SESSION['token_expiration'])
        || time() >= $_SESSION['token_expiration']
    ) {

        header("Location: ../login.php");
        session_unset();
        session_destroy();
        exit();
    }
}
