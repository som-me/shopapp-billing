<?php
require_once "../core/config.php";
require_once "../core/db.php";
require_once "../core/middleware.php";

requireLogin();

$products = $conn->query("SELECT * FROM products ORDER BY code ASC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inventory</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>
    <div class="mobile-app">

        <div class="header">
            <h2>📦 Inventory Manager</h2>
            <p>Update Stock Easily</p>
        </div>

        <div class="card">

            <table style="width:100%; font-size:14px;">
                <tr>
                    <th>Code</th>
                    <th>Stock</th>
                    <th>Update</th>
                </tr>

                <?php while ($p = $products->fetch_assoc()): ?>
                    <tr>
                        <form method="POST" action="<?= BASE_URL ?>/handlers/update-stock.php">
                            <td><?= $p["code"] ?></td>

                            <td>
                                <input type="number" step="0.01"
                                    name="stock"
                                    value="<?= $p["stock"] ?>">
                            </td>

                            <td>
                                <input type="hidden" name="code" value="<?= $p["code"] ?>">
                                <button class="btn-primary" style="padding:8px;">Save</button>
                            </td>
                        </form>
                    </tr>
                <?php endwhile; ?>

            </table>

        </div>

    </div>
</body>

</html>