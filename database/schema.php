<?php
// database/schema.php

/*
Run this file ONCE in browser:

http://localhost/shopapp/database/schema.php
*/

$conn = new mysqli("localhost", "root", "");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* Create Database */
$conn->query("CREATE DATABASE IF NOT EXISTS shopapp_db");

/* Use Database */
$conn->select_db("shopapp_db");

/* Admin Users Table */
$conn->query("
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

/* Products Table */
$conn->query("
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    is_meter_based BOOLEAN DEFAULT 0,
    stock DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

/* Bills Table */
$conn->query("
CREATE TABLE IF NOT EXISTS bills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    payment_method VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admins(id)
)
");

/* Bill Items Table */
$conn->query("
CREATE TABLE IF NOT EXISTS bill_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    bill_id INT NOT NULL,
    product_code VARCHAR(20),
    price DECIMAL(10,2),
    meters DECIMAL(10,2),
    quantity INT DEFAULT 1,
    final_price DECIMAL(10,2),
    FOREIGN KEY (bill_id) REFERENCES bills(id)
)
");

/* Expenses Table */
$conn->query("
CREATE TABLE IF NOT EXISTS expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150),
    amount DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

echo "<h2>✅ Database & Tables Created Successfully!</h2>";
?>
