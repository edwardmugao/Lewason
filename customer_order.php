<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// It enables theconnections to the database.
$conn = new mysqli("localhost", "root", "", "Login");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission to the backed
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST['customer_name'];
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];
    $order_status = $_POST['order_status'];
    $payment_amount = floatval($_POST['payment_amount']);

    $stmt = $conn->prepare("INSERT INTO customer_orders (customer_name, customer_id, product_id, quantity, order_status, payment_amount) VALUES (?, ?, ?, ?, ?, ?)");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssisd", $customer_name, $customer_id, $product_id, $quantity, $order_status, $payment_amount);
    // Its closes everything and returns to the main page
     if ($stmt->execute()) {
    header("Location: project.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

    $stmt->close();
}
$conn->close();
?>
