<?php
require_once "../core/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

    <div class="mobile-app">

        <div class="header">
            <h2><i class="fa-solid fa-user-plus"></i> Register</h2>
            <p>Create a new admin account</p>
        </div>

        <div class="card">

            <form action="<?= BASE_URL ?>/handlers/register.php" method="POST">

                <label><i class="fa-solid fa-user"></i> Username</label>
                <input type="text" name="username" placeholder="Choose username" required>

                <label><i class="fa-solid fa-envelope"></i> Email</label>
                <input type="email" name="email" placeholder="Enter email" required>

                <label><i class="fa-solid fa-key"></i> Password</label>
                <input type="password" name="password" placeholder="Create password" required>

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-check"></i> Register
                </button>

            </form>

            <p class="bottom-link">
                Already have an account? <a href="<?= BASE_URL ?>/index.php">Login Here</a>
            </p>

        </div>

    </div>

</body>

</html>
