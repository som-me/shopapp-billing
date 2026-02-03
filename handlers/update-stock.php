<?php
require_once "../core/config.php";
require_once "../core/db.php";

$code  = $_POST["code"];
$stock = floatval($_POST["stock"]);

$conn->query("UPDATE products SET stock=$stock WHERE code='$code'");

header("Location: " . BASE_URL . "/admin/inventory.php");
exit;
?>
