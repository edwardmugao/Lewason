<?php
// Connect to Login database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "Login";

$conn = new mysqli($host, $username, $password, $dbname);
 
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $poultry_type = $_POST['poultry_type'];
    $quantity = $_POST['quantity'];
    $recorded_by = $_POST['recorded_by'];

    $stmt = $conn->prepare("INSERT INTO birds (poultry_type, quantity, recorded_by) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $poultry_type, $quantity, $recorded_by);

    if ($stmt->execute()) {
    header("Location: project.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}
    $stmt->close();
}
?>

 