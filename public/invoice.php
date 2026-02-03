<?php
require_once "../core/config.php";
require_once "../core/db.php";
require_once "../core/middleware.php";

requireLogin();

if (!isset($_GET["bill_id"])) {
    die("Bill ID Missing!");
}

$bill_id = intval($_GET["bill_id"]);

$bill = $conn->query("SELECT * FROM bills WHERE id=$bill_id")->fetch_assoc();
$items = $conn->query("SELECT * FROM bill_items WHERE bill_id=$bill_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #<?= $bill_id ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f9fafb;
        }

        .invoice-box {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .meta p {
            margin: 4px 0;
            font-size: 14px;
            color: #333;
        }

        hr {
            margin: 12px 0;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        td {
            padding: 6px 0;
            font-size: 14px;
        }

        tr {
            border-bottom: 1px dashed #ccc;
        }

        .total {
            text-align: right;
            font-size: 17px;
            margin-top: 12px;
            font-weight: bold;
        }

        .print-btn {
            width: 100%;
            margin-top: 18px;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: #16a34a;
            color: white;
            font-size: 15px;
            cursor: pointer;
        }

        .print-btn i {
            margin-right: 6px;
        }

        /* ========================= */
        /* THERMAL RECEIPT PRINT MODE */
        /* ========================= */

        @media print {

            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .invoice-box {
                width: 80mm;
                max-width: 80mm;
                padding: 5mm;
                margin: 0;
                border-radius: 0;
                box-shadow: none;
            }

            h2 {
                font-size: 16px;
            }

            .meta p {
                font-size: 12px;
            }

            td {
                font-size: 12px;
            }

            .total {
                font-size: 14px;
                text-align: center;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="invoice-box">

    <h2>
        <i class="fa-solid fa-receipt"></i>
        Meher's Shop Invoice
    </h2>

    <div class="meta">
        <p><i class="fa-solid fa-hashtag"></i> Bill ID: <?= $bill["id"] ?></p>
        <p><i class="fa-solid fa-calendar-days"></i>
            Date: <?= date("d M Y, h:i A", strtotime($bill["created_at"])) ?>
        </p>
        <p><i class="fa-solid fa-credit-card"></i>
            Payment: <?= $bill["payment_method"] ?>
        </p>
    </div>

    <hr>

    <table>
        <?php while ($row = $items->fetch_assoc()): ?>
            <tr>
                <td>
                    <strong><?= $row["product_code"] ?></strong><br>
                    <small>
                        ₹<?= $row["price"] ?>
                        <?php if ($row["meters"] > 0): ?>
                            × <?= $row["meters"] ?>m
                        <?php endif; ?>
                    </small>
                </td>

                <td style="text-align:right;">
                    ₹<?= $row["final_price"] ?>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p class="total">
        Total: ₹<?= $bill["total_amount"] ?>
    </p>

    <p style="text-align:center;font-size:12px;margin-top:10px;color:gray;">
        Thank you for shopping with Us <br>
        --Meher Sambalpuri Collection--
    </p>

    <button class="print-btn" onclick="window.print()">
        <i class="fa-solid fa-print"></i> Print Receipt
    </button>

</div>

</body>
</html>
