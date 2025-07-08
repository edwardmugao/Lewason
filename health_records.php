                <?php
                $host = "localhost";
                $user = "root";
                $pass = "";
                $db = "Login";

                $conn = new mysqli($host, $user, $pass, $db);

                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $record_date = $_POST["record_date"];
                    $record_type = $_POST["record_type"];
                    $description = $_POST["description"];
                    $staff = $_POST["staff"];

                    $stmt = $conn->prepare("INSERT INTO records (record_date, record_type, description, staff) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $record_date, $record_type, $description, $staff);

                    if ($stmt->execute()) {
                    header("Location: project.php");
                    exit();
                } else {
                    echo "Error: " . $stmt->error;
                }
                }
                ?>
