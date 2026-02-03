<?php
require_once "../core/config.php";
require_once "../core/helpers.php";

session_start();

$index = intval($_GET["id"]);

if (isset($_SESSION["cart"][$index])) {
    unset($_SESSION["cart"][$index]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);
}

redirect("/public/billing.php");
?>
