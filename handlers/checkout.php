<?php
require_once "../core/config.php";
require_once "../core/db.php";
require_once "../core/helpers.php";

session_start();

if (!isset($_SESSION["cart"]) || count($_SESSION["cart"]) == 0) {
    redirect("/public/billing.php");
}

$admin_id = $_SESSION["admin"]["id"];
$payment  = sanitize($_POST["payment"]);

$total = 0;
foreach ($_SESSION["cart"] as $item) {
    $total += $item["final"];
}

/* Insert Bill */
$stmt = $conn->prepare("
    INSERT INTO bills (admin_id, total_amount, payment_method)
    VALUES (?, ?, ?)
");
$stmt->bind_param("ids", $admin_id, $total, $payment);
$stmt->execute();

$bill_id = $conn->insert_id;

/* Insert Bill Items + Reduce Stock */
foreach ($_SESSION["cart"] as $item) {

    $code   = $item["code"];
    $price  = $item["price"];
    $meters = $item["meters"];
    $final  = $item["final"];

    /* Save Bill Item */
    $stmt2 = $conn->prepare("
        INSERT INTO bill_items (bill_id, product_code, price, meters, final_price)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt2->bind_param("isddd", $bill_id, $code, $price, $meters, $final);
    $stmt2->execute();

    /* Reduce Stock */
    $reduceQty = ($meters > 0) ? $meters : 1;

    $conn->query("
        UPDATE products
        SET stock = stock - $reduceQty
        WHERE code = '$code'
    ");
}

/* Clear Cart */
unset($_SESSION["cart"]);

/* ✅ Redirect to Invoice Page */
header("Location: " . BASE_URL . "/public/invoice.php?bill_id=$bill_id");
exit;
