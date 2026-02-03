<?php
require_once "../core/config.php";
require_once "../core/db.php";
require_once "../core/helpers.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    redirect("/index.php");
}

/* Get Form Data */
$username = sanitize($_POST["username"]);
$password = $_POST["password"];

/* Fetch Admin */
$stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$admin  = $result->fetch_assoc();

/* Verify Password */
if ($admin && password_verify($password, $admin["password"])) {

    // ✅ Store Admin in Session
    $_SESSION["admin"] = [
        "id" => $admin["id"],
        "username" => $admin["username"]
    ];

    // ✅ Redirect to Billing Counter
    header("Location: " . BASE_URL . "/public/billing.php");
    exit;

} else {

    echo "<h2>❌ Invalid Username or Password</h2>";
    echo "<a href='" . BASE_URL . "/index.php'>Go Back</a>";
}
?>
