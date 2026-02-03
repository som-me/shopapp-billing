<?php
require_once "../core/config.php";
require_once "../core/helpers.php";

session_start();

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

$action = $_POST["action"] ?? "";

/* Add */
if ($action === "add") {
    $code   = sanitize($_POST["code"]);
    $price  = floatval($_POST["price"]);
    $meters = floatval($_POST["meters"] ?? 0);

    $final = $price;

    if (strpos($code, "SR") === 0) {
        $final = $price * 0.70;
    }

    if ($meters > 0) {
        $final = $price * $meters;
    }

    $_SESSION["cart"][] = [
        "code" => $code,
        "price" => $price,
        "meters" => $meters,
        "final" => $final
    ];
}

/* Remove */
if ($action === "remove") {
    $index = intval($_POST["index"]);
    unset($_SESSION["cart"][$index]);
    $_SESSION["cart"] = array_values($_SESSION["cart"]);
}

/* Response */
$total = 0;
foreach ($_SESSION["cart"] as $item) {
    $total += $item["final"];
}

echo json_encode([
    "cart" => $_SESSION["cart"],
    "total" => $total
]);
