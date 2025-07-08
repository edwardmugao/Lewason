<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "Login";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Alter table to add 'employee_salary' column if not exists
$alter_sql = "ALTER TABLE employees ADD COLUMN IF NOT EXISTS employee_salary DECIMAL(10,2)";
$conn->query($alter_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $worker_id   = trim($_POST['worker_id']);
    $full_name   = trim($_POST['full_name']);
    $gender      = trim($_POST['gender']);
    $phone       = trim($_POST['phone']);
    $worker_type = trim($_POST['worker_type']);
    $salary      = trim($_POST['salary']);

    $stmt = $conn->prepare("INSERT INTO employees (worker_id, employee_name, gender, employee_phone_number, employee_worker_type, employee_salary) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sssssd", $worker_id, $full_name, $gender, $phone, $worker_type, $salary);

    if ($stmt->execute()) {
        header("Location: project.php");
        exit();
    } else {
        echo "Error executing query: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
