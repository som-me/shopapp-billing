<?php
require_once "../core/config.php";
require_once "../core/db.php";
require_once "../core/helpers.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect("/public/register.php");
}

/* Get Form Data */
$username = sanitize($_POST["username"]);
$email    = sanitize($_POST["email"]);
$password = $_POST["password"];

/* Hash Password */
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

/* Insert Admin */
$stmt = $conn->prepare("
    INSERT INTO admins (username, email, password)
    VALUES (?, ?, ?)
");

$stmt->bind_param("sss", $username, $email, $hashedPassword);

if ($stmt->execute()) {

    // ✅ After registration → go to Login Page (index.php)
    header("Location: " . BASE_URL . "/index.php");
    exit;

} else {
    echo "❌ Registration Failed: " . $conn->error;
}
?>
