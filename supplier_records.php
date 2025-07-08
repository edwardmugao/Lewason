 <?php
// Connect to the Login database
$host = "localhost";
$user = "root";
$pass = "";
$db = "Login";

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the supplier_records table if it doesn't exist
$createTable = "CREATE TABLE IF NOT EXISTS supplier_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    supplier_name VARCHAR(100) NOT NULL,
    contact_info VARCHAR(150) NOT NULL,
    items_supplied TEXT NOT NULL,
    delivery_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($createTable);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $supplier_name = $_POST['supplier_name'];
    $contact_info = $_POST['contact_info'];
    $items_supplied = $_POST['items_supplied'];
    $delivery_date = $_POST['delivery_date'];

    // Insert data into the table
    $stmt = $conn->prepare("INSERT INTO supplier_records (supplier_name, contact_info, items_supplied, delivery_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $supplier_name, $contact_info, $items_supplied, $delivery_date);

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
