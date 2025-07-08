<?php
// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "Login";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get total employees
$employeeQuery = "SELECT COUNT(*) AS total FROM employees";
$employeeResult = $conn->query($employeeQuery);
$totalEmployees = $employeeResult->fetch_assoc()['total'];

// Get total products
$productQuery = "SELECT COUNT(*) AS total FROM products";
$productResult = $conn->query($productQuery);
$totalProducts = $productResult->fetch_assoc()['total'];

// Get total customer orders
$orderQuery = "SELECT COUNT(*) AS total FROM customer_orders";
$orderResult = $conn->query($orderQuery);
$totalOrders = $orderResult->fetch_assoc()['total'];

// Get total birds
$birdsQuery = "SELECT SUM(quantity) AS total FROM birds";
$birdsResult = $conn->query($birdsQuery);
$totalBirds = $birdsResult->fetch_assoc()['total'] ?? 0;

$conn->close();
?>
