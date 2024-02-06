<?php
// If the request is not an AJAX request, redirect to the index page
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    header('Location: ../index.php');
    exit;
}
