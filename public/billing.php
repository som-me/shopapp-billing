<?php
require_once "../core/config.php";
require_once "../core/middleware.php";

requireLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Billing Counter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>

    <div class="mobile-app">

        <!-- Header -->
        <div class="header">
            <h2><i class="fa-solid fa-receipt"></i> Billing Counter</h2>
            <p>Welcome, <?= $_SESSION["admin"]["username"] ?></p>
        </div>

        <!-- Add Item Form (AJAX) -->
        <div class="card">

            <form id="billingForm">

                <label><i class="fa-solid fa-barcode"></i> Product Code</label>
                <input id="code" type="text" placeholder="SR01 / KP01 / SH01" required>

                <label><i class="fa-solid fa-indian-rupee-sign"></i> Price / Meter Price</label>
                <input id="price" type="number" placeholder="Enter price ₹" required>

                <label><i class="fa-solid fa-ruler-horizontal"></i> Cloth Length (Meters)</label>
                <input id="meters" type="number" step="0.01" placeholder="Only for cloth">

                <button class="btn-primary" type="submit">
                    <i class="fa-solid fa-plus"></i> Add to Cart
                </button>

            </form>

        </div>

        <!-- Cart Section -->
        <div class="card cart-box">

            <h3><i class="fa-solid fa-cart-shopping"></i> Cart Items</h3>

            <!-- Dynamic Cart Items -->
            <div id="cartItems"></div>

            <!-- Total -->
            <h3 id="cartTotal" style="margin-top:15px;">Total: ₹0</h3>

            <!-- Checkout -->
            <form action="<?= BASE_URL ?>/handlers/checkout.php" method="POST">

                <label><i class="fa-solid fa-credit-card"></i> Payment Method</label>
                <select name="payment">
                    <option value="Cash">Cash</option>
                    <option value="UPI">UPI</option>
                    <option value="Card">Card</option>
                </select>

                <button type="submit" class="btn-primary">
                    <i class="fa-solid fa-check"></i> Checkout Bill
                </button>

            </form>

        </div>

        <!-- Logout -->
        <div class="card" style="text-align:center;">
            <a href="<?= BASE_URL ?>/handlers/logout.php" class="btn-primary">
                <i class="fa-solid fa-right-from-bracket"></i> Logout Safely
            </a>
        </div>

    </div>


    <!-- ✅ REALTIME CART SYSTEM -->
    <script>
        async function loadCart() {
            let res = await fetch("<?= BASE_URL ?>/handlers/cart-api.php");
            let data = await res.json();

            let cartDiv = document.getElementById("cartItems");
            cartDiv.innerHTML = "";

            if (data.cart.length === 0) {
                cartDiv.innerHTML =
                    "<p style='text-align:center;color:gray;'>No items yet</p>";
            }

            data.cart.forEach((item, index) => {
                cartDiv.innerHTML += `
        <div class="cart-item">
        <div>
            <strong>${item.code}</strong><br>
            <small>
            ${item.meters > 0
                        ? item.meters + "m × ₹" + item.price
                        : "₹" + item.price}
            </small>
        </div>

        <span style="font-weight:bold;">₹${item.final}</span>

        <button onclick="removeItem(${index})"
            style="border:none;background:none;font-size:20px;color:#ef4444;cursor:pointer;">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>

    </div>
    `;
            });

            document.getElementById("cartTotal").innerText =
                "Total: ₹" + data.total;
        }

        /* Add Item */
        document.getElementById("billingForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            let code = document.getElementById("code").value;
            let price = document.getElementById("price").value;
            let meters = document.getElementById("meters").value;

            let formData = new FormData();
            formData.append("action", "add");
            formData.append("code", code);
            formData.append("price", price);
            formData.append("meters", meters);

            await fetch("<?= BASE_URL ?>/handlers/cart-api.php", {
                method: "POST",
                body: formData
            });

            this.reset();
            loadCart();
        });

        /* Remove Item */
        async function removeItem(index) {
            let formData = new FormData();
            formData.append("action", "remove");
            formData.append("index", index);

            await fetch("<?= BASE_URL ?>/handlers/cart-api.php", {
                method: "POST",
                body: formData
            });

            loadCart();
        }

        loadCart();
    </script>

</body>

</html>