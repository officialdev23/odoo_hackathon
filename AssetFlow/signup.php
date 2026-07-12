<?php

require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/includes/session.php";
require_once __DIR__ . "/includes/flash.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | <?= APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>

    <div class="login-container">
        <!-- Using signup-card class for wider 2-column layout -->
        <div class="login-card signup-card">
            
            <!-- Left Side: Illustration Panel -->
            <div class="auth-illustration-side">
                <img src="assets/Illustrations/Singup_Illustration.png" alt="Registration Illustration">
                <div class="auth-illustration-caption">
                    <h4>Join AssetFlow Pro</h4>
                    <p>Start tracking assignments, managing inventory, and streamlining maintenance workflows in minutes.</p>
                </div>
            </div>

            <!-- Right Side: Form Panel -->
            <div class="auth-form-side">
                
                <div class="logo">
                    <div class="logo-header">
                        <img src="assets/logo.svg" alt="AssetFlow Logo" style="width: 42px; height: 42px;">
                        <h2>Create Account</h2>
                    </div>
                    <p>Register to manage your enterprise assets</p>
                </div>

                <!-- Session Alert Flash Messages -->
                <?php showFlash(); ?>

                <form id="signup-form" action="controllers/AuthController.php?action=register" method="POST" novalidate>
                    
                    <!-- 2-Column Grid for Form Fields -->
                    <div class="grid-2-cols">
                        
                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first-name">First Name</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user input-icon-left"></i>
                                <input
                                    type="text"
                                    id="first-name"
                                    name="first_name"
                                    class="form-control"
                                    placeholder="John"
                                    required>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="last-name">Last Name</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user input-icon-left"></i>
                                <input
                                    type="text"
                                    id="last-name"
                                    name="last_name"
                                    class="form-control"
                                    placeholder="Doe"
                                    required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email-field">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-envelope input-icon-left"></i>
                                <input
                                    type="email"
                                    id="email-field"
                                    name="email"
                                    class="form-control"
                                    placeholder="john.doe@company.com"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    title="Please enter a valid email address"
                                    required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone-field">Phone Number</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-phone input-icon-left"></i>
                                <input
                                    type="text"
                                    id="phone-field"
                                    name="phone"
                                    class="form-control"
                                    placeholder="9876543210"
                                    pattern="\d{10}"
                                    title="Phone number must be exactly 10 digits"
                                    required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password-field">Password</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon-left"></i>
                                <input
                                    type="password"
                                    id="password-field"
                                    name="password"
                                    class="form-control form-control-password"
                                    placeholder="••••••••"
                                    minlength="8"
                                    title="Password must be at least 8 characters long"
                                    required>
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password-field', this)">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="confirm-password-field">Confirm Password</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-key input-icon-left"></i>
                                <input
                                    type="password"
                                    id="confirm-password-field"
                                    name="confirm_password"
                                    class="form-control form-control-password"
                                    placeholder="••••••••"
                                    minlength="8"
                                    title="Password must be at least 8 characters long"
                                    required>
                                <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('confirm-password-field', this)">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100 mt-2 mb-3">
                        <span>Create Account</span>
                        <i class="fa-solid fa-user-plus"></i>
                    </button>

                </form>

                <!-- Login Redirect Link -->
                <div class="text-center mt-3 auth-footer-text">
                    Already have an account?
                    <a href="login.php">Login</a>
                </div>

            </div>

        </div>
    </div>

    <!-- UI Password Reveal Script and Validation -->
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

        const passwordField = document.getElementById('password-field');
        const confirmPasswordField = document.getElementById('confirm-password-field');

        function validatePasswordMatch() {
            if (passwordField.value !== confirmPasswordField.value) {
                confirmPasswordField.setCustomValidity("Passwords do not match");
            } else {
                confirmPasswordField.setCustomValidity("");
            }
        }

        // Custom UI Validation Auto Detect
        const form = document.getElementById('signup-form');
        const inputs = form.querySelectorAll('input');

        inputs.forEach(input => {
            // Create error message element dynamically
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-danger mt-1';
            errorDiv.style.fontSize = '0.875em';
            errorDiv.style.display = 'none';
            input.closest('.mb-3').appendChild(errorDiv);

            const validateInput = () => {
                // Ensure custom validity for passwords is set first
                if (input === passwordField || input === confirmPasswordField) {
                    validatePasswordMatch();
                }

                if (!input.validity.valid) {
                    input.classList.add('is-invalid');
                    input.closest('.input-wrapper').style.borderColor = '#dc3545'; 
                    errorDiv.textContent = input.validationMessage;
                    errorDiv.style.display = 'block';
                } else {
                    input.classList.remove('is-invalid');
                    input.closest('.input-wrapper').style.borderColor = ''; 
                    errorDiv.style.display = 'none';
                }
            };

            // Detect changes while typing
            input.addEventListener('input', validateInput);
            input.addEventListener('blur', validateInput);
        });

        // Validate on form submit
        form.addEventListener('submit', event => {
            let isValid = true;
            inputs.forEach(input => {
                if (input === passwordField || input === confirmPasswordField) {
                    validatePasswordMatch();
                }
                
                if (!input.validity.valid) {
                    isValid = false;
                    input.classList.add('is-invalid');
                    input.closest('.input-wrapper').style.borderColor = '#dc3545';
                    const errorDiv = input.closest('.mb-3').querySelector('.text-danger');
                    errorDiv.textContent = input.validationMessage;
                    errorDiv.style.display = 'block';
                }
            });

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });
    </script>

</body>

</html>