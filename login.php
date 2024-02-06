<?php
session_start();
if (isset($_SESSION['access_token'])) {
    $token_expiration = $_SESSION['token_expiration'];
    if (time() < $token_expiration) {
        header("Location: index.php");
        exit();
    } else {
        session_unset();
        session_destroy();
    }
}
require_once 'includes/login-handler.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #e9ecef !important;
        }

        .form-signin {
            width: 100%;
            max-width: 400px;
            padding: 15px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 2%;
            background-color: aliceblue;
        }
    </style>
</head>

<body>
    <main class="form-signin">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form method="POST" action="includes/login-handler.php">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mt-3">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="row d-flex justify-content-between mt-3">

            </div>
            <div class="row d-flex justify-content-around mt-3">
                <div class="col-md-4">
                    <button class="w-100 btn btn-primary" type="submit">Sign in</button>
                </div>
            </div>
            <p class="mt-5 mb-3 text-muted">&copy; 2024</p>
        </form>
    </main>
</body>

</html>