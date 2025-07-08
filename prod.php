 <?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "Login";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $product_id = trim($_POST['product_id']);
    $product_name = trim($_POST['product_name']);
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];
    $registered_by = trim($_POST['registered_by']);

   
    $stmt = $conn->prepare("INSERT INTO products (product_id, product_name, quantity, price, registered_by) VALUES (?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssids", $product_id, $product_name, $quantity, $price, $registered_by);

    if ($stmt->execute()) {
    header("Location: project.php");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
