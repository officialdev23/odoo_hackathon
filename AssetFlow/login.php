<?php


require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/includes/session.php";
require_once __DIR__ . "/includes/flash.php";
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | <?= APP_NAME ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <div class="logo">

                <h2>AssetFlow Pro</h2>

                <p>Enterprise Asset Management</p>

            </div>

            <?php showFlash(); ?>

            <form action="controllers/AuthController.php?action=login" method="POST">

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        required>

                </div>

                <div class="mb-3">

                    <label>Password</label>

                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        required>

                </div>

                <div class="d-flex justify-content-between mb-3">

                    <div>

                        <input type="checkbox" name="remember">

                        Remember Me

                    </div>

                    <a href="forgot-password.php">

                        Forgot Password?

                    </a>

                </div>

                <button class="btn btn-primary w-100">

                    Login

                </button>

            </form>

            <div class="text-center mt-3">

                Don't have an account?

                <a href="signup.php">

                    Sign Up

                </a>

            </div>

        </div>

    </div>

</body>

</html>