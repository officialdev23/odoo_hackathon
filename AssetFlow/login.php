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
            
            <!-- Left Side: Illustration Panel -->
            <div class="auth-illustration-side">
                <img src="assets/Illustrations/Login_illustration.png" alt="Login Illustration">
                <div class="auth-illustration-caption">
                    <h4>AssetFlow Pro</h4>
                    <p>Track, manage, and optimize your organization's physical and digital assets in one unified platform.</p>
                </div>
            </div>

            <!-- Right Side: Form Panel -->
            <div class="auth-form-side">
                
                <div class="logo">
                    <div class="logo-header">
                        <img src="assets/logo.svg" alt="AssetFlow Logo" style="width: 42px; height: 42px;">
                        <h2>AssetFlow Pro</h2>
                    </div>
                    <p>Welcome back! Please login to your account.</p>
                </div>

                <!-- Session Alert Flash Messages -->
                <?php showFlash(); ?>

                <form action="controllers/AuthController.php?action=login" method="POST">
                    
                    <!-- Email field -->
                    <div class="mb-3">
                        <label for="email-field">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-envelope input-icon-left"></i>
                            <input
                                type="email"
                                id="email-field"
                                class="form-control"
                                placeholder="name@company.com"
                                name="email"
                                required>
                        </div>
                    </div>

                    <!-- Password field -->
                    <div class="mb-3">
                        <label for="password-field">Password</label>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock input-icon-left"></i>
                            <input
                                type="password"
                                id="password-field"
                                class="form-control form-control-password"
                                placeholder="••••••••"
                                name="password"
                                required>
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password-field', this)">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password link -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check d-flex align-items-center gap-2 m-0 p-0">
                            <input type="checkbox" id="remember-checkbox" class="form-check-input m-0" name="remember">
                            <label for="remember-checkbox" class="form-check-label m-0">Remember Me</label>
                        </div>
                        <a href="forgot-password.php" class="auth-links">
                            Forgot Password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        <span>Sign In</span>
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </button>

                </form>

                <!-- Signup Redirect Link -->
                <div class="text-center mt-3 auth-footer-text">
                    Don't have an account?
                    <a href="signup.php">Create Account</a>
                </div>

            </div>

        </div>
    </div>

    <!-- UI Password Reveal Script -->
    <script>
        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>