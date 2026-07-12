<?php

require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/includes/session.php";
require_once __DIR__ . "/includes/flash.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | <?= APP_NAME ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

    <div class="login-container">

        <div class="login-card">

            <h2 class="text-center mb-4">Create Account</h2>

            <?php showFlash(); ?>

            <form action="controllers/AuthController.php?action=register" method="POST">

                <div class="mb-3">

                    <label>First Name</label>

                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label>Last Name</label>

                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label>Phone</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label>Password</label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="confirm_password"
                        class="form-control"
                        required>

                </div>

                <button class="btn btn-primary w-100">

                    Create Account

                </button>

            </form>

            <div class="text-center mt-3">

                Already have an account?

                <a href="login.php">

                    Login

                </a>

            </div>

        </div>

    </div>

</body>

</html>