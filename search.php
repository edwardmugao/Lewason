 <?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "Login");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$output = "";

// Deletion handler
if (isset($_POST['delete']) && isset($_POST['table']) && isset($_POST['id']) && isset($_POST['id_column'])) {
    $table = $conn->real_escape_string($_POST['table']);
    $id_column = $conn->real_escape_string($_POST['id_column']);
    $id = $conn->real_escape_string($_POST['id']);

    $deleteQuery = "DELETE FROM `$table` WHERE `$id_column` = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("s", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Deleted successfully";
    } else {
        echo "Delete failed";
    }
    $stmt->close();
    $conn->close();
    exit;
}

if (isset($_POST['query'])) {
    $search = "%" . $_POST['query'] . "%";

    $tablesResult = $conn->query("SHOW TABLES");
    if ($tablesResult->num_rows > 0) {
        $foundAny = false;
        while ($tableRow = $tablesResult->fetch_array()) {
            $tableName = $tableRow[0];
            $columnsResult = $conn->query("SHOW COLUMNS FROM `$tableName`");
            $textColumns = [];
            $primaryKey = null;

            while ($col = $columnsResult->fetch_assoc()) {
                if ($col['Key'] === 'PRI') $primaryKey = $col['Field'];
                if (preg_match('/char|text|varchar/i', $col['Type'])) {
                    $textColumns[] = $col['Field'];
                }
            }

            if (count($textColumns) === 0 || !$primaryKey) continue;

            $conditions = array_map(fn($col) => "`$col` LIKE ?", $textColumns);
            $whereClause = implode(" OR ", $conditions);

            $query = "SELECT * FROM `$tableName` WHERE $whereClause";
            $stmt = $conn->prepare($query);
            if (!$stmt) continue;

            $types = str_repeat("s", count($textColumns));
            $params = array_fill(0, count($textColumns), $search);

            $bind_names[] = & $types;
            for ($i = 0; $i < count($params); $i++) {
                $bind_names[] = & $params[$i];
            }
            call_user_func_array([$stmt, 'bind_param'], $bind_names);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $foundAny = true;
                $output .= "<h4>Results from table: <strong>$tableName</strong></h4><table><thead><tr>";

                $fields = $result->fetch_fields();
                foreach ($fields as $col) {
                    $output .= "<th>" . htmlspecialchars($col->name) . "</th>";
                }
                $output .= "<th>Action</th></tr></thead><tbody>";

                while ($row = $result->fetch_assoc()) {
                    $output .= "<tr>";
                    foreach ($row as $cell) {
                        $output .= "<td>" . htmlspecialchars($cell) . "</td>";
                    }

                    $output .= "<td>
                        <button onclick=\"deleteRow('$tableName', '$primaryKey', '{$row[$primaryKey]}')\">Delete</button>
                    </td>";
                    $output .= "</tr>";
                }
                $output .= "</tbody></table><br>";
            }

            $stmt->close();
            unset($bind_names);
        }

        if (!$foundAny) {
            $output = "<p>No matching records found.</p>";
        }
    } else {
        $output = "<p>No tables found in the database.</p>";
    }
} else {
    $output = "<p>Please enter a search query.</p>";
}

echo $output;
$conn->close();
?>
