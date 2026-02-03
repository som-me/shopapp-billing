<?php
require_once "../core/config.php";
require_once "../core/db.php";

/*
Run this ONCE:

http://localhost/shopapp/database/seed_products.php
*/

$conn->query("DELETE FROM products");

/* Insert Dummy Products */
$conn->query("
INSERT INTO products (code, name, category, is_meter_based, stock)
VALUES
('SR01', 'Sambalpuri Saree Classic', 'Saree', 0, 10),
('SR02', 'Sambalpuri Saree Premium', 'Saree', 0, 8),

('SH01', 'Sambalpuri Shirt Regular', 'Shirt', 0, 15),
('SH02', 'Sambalpuri Shirt Designer', 'Shirt', 0, 12),

('KP01', 'Thane Kapda Roll', 'Kapda', 1, 50.00),
('KP02', 'Cotton Cloth Roll', 'Kapda', 1, 40.50),

('DH01', 'Dhoti Traditional', 'Dhoti', 0, 20),
('RM01', 'Rumal Pack', 'Rumal', 0, 25),
('TW01', 'Towel Large', 'Towel', 0, 18)
");

echo "<h2>✅ Dummy Products Inserted Successfully!</h2>";
echo "<a href='".BASE_URL."/public/billing.php'>➡ Go to Billing</a>";
?>
