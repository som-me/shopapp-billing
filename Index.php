<?php
require_once "core/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login - Shop Billing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

    <div class="mobile-app">

        <!-- Header -->
        <div class="header">
            <h2><i class="fa-solid fa-lock"></i> Admin Login</h2>
            <p>Login to access billing counter</p>
        </div>

        <!-- Login Card -->
        <div class="card">

            <!-- Login Form -->
            <form action="<?= BASE_URL ?>/handlers/login.php" method="POST">

                <label><i class="fa-solid fa-user"></i> Admin ID</label>
                <input type="text" name="username" placeholder="Enter username" required>

                <label><i class="fa-solid fa-key"></i> Password</label>
                <input type="password" name="password" placeholder="Enter password" required>

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </button>

            </form>

            <!-- Register Link -->
            <p class="bottom-link">
                New here? <a href="<?= BASE_URL ?>/public/register.php">Create New Account</a>
            </p>

        </div>

        <p class="footer-text">
            Shop Billing System © <?= date("Y") ?>
        </p>

    </div>

</body>

</html>
