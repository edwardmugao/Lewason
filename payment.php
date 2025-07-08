 <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$username = "root";
$password = "";
$dbname = "Login";

// DB connection
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['payee'], $_POST['amount'], $_POST['service'], 
              $_POST['bank'], $_POST['account'])
    ) {
        $payee = $_POST['payee'];
        $amount = floatval($_POST['amount']);
        $service = $_POST['service'];
        $bank = $_POST['bank'];
        $account = $_POST['account'];
        $date = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO payments (payee, amount, service, bank, account, date) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sdssss", $payee, $amount, $service, $bank, $account, $date);
        if ($stmt->execute()) {
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Print Invoice or Cheque</title>
                 
                <style>
                    body {
                        font-family: 'Segoe UI', sans-serif;
                        padding: 20px;
                         background-color:rgb(195, 218, 243);
                    }
                    .print-options {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    select, .btn-print {
                        padding: 10px;
                        font-size: 16px;
                        margin: 5px;
                    }
                    .btn-print {
                        background-color: #007bff;
                        color: white;
                        border: none;
                        cursor: pointer;
                    }
                    .btn-print:hover {
                        background-color: #0056b3;
                    }
                    .section {
                        border: 1px solid #ccc;
                        padding: 25px;
                        margin: 20px auto;
                        width: 80%;
                        background-color: wheat;
                        background-image: url('https://www.transparentpng.com/thumb/chicken/VuK1aC-rooster-hen-chicken-free-png.png');
                        background-size: 300px;
                        background-position: center;
                        background-repeat: no-repeat;
                        background-blend-mode: lighten;
                    }
                    .cheque {
                        border-style: dashed;
                        background: none;
                        background-color: wheat;
                    }
                    h2 {
                        text-align: center;
                        color: #333;
                    }
                          @media print {
                            .print-options {
                                display: none !important;
                                
                            }
                        }

                </style>
                <script>
                    function printSection() {
                        const selected = document.getElementById('docType').value;
                        const invoice = document.getElementById('invoice');
                        const cheque = document.getElementById('cheque');

                        if (selected === 'invoice') {
                            cheque.style.display = 'none';
                            invoice.style.display = 'block';
                        } else if (selected === 'cheque') {
                            invoice.style.display = 'none';
                            cheque.style.display = 'block';
                        } else {
                            alert("Please select what to print.");
                            return;
                        }

                        window.print();

                        // Reset view after printing
                        setTimeout(() => {
                            invoice.style.display = 'block';
                            cheque.style.display = 'block';
                        }, 1000);
                    }
                </script>
            </head>
            <body>
                <div class="print-options">
                    <label for="docType">Select Document to Print:</label>
                    <select id="docType">
                        <option value="">-- Select --</option>
                        <option value="invoice">Invoice</option>
                        <option value="cheque">Cheque</option>
                    </select>
                    <button class="btn-print" onclick="printSection()">🖨️ Print</button>
                </div>

                <div id="invoice" class="section">
                    <h2>Lewason Poultry - Payment Invoice</h2>
                    <p><strong>Date:</strong> <?php echo $date; ?></p>
                    <p><strong>Payee:</strong> <?php echo $payee; ?></p>
                    <p><strong>Amount:</strong> Ksh <?php echo number_format($amount, 2); ?></p>
                    <p><strong>Service:</strong> <?php echo $service; ?></p>
                    <p><strong>Bank:</strong> <?php echo $bank; ?></p>
                    <p><strong>Account Number:</strong> <?php echo $account; ?></p>
                    <p><strong>Status:</strong> Payment Successfully Recorded</p>
                        <hr> <br> <br>
                    <p>Authorized Signature: __________________________</p>
                </div>

                <div id="cheque" class="section cheque">
                    <h2>Lewason Poultry - Cheque</h2>
                    <p>Pay <strong><?php echo $payee; ?></strong> <br> <br> The sum of <strong>Ksh <?php echo number_format($amount, 2); ?></strong></p>
                    <p>Bank: <?php echo $bank; ?> <br> <br> Account: <?php echo $account; ?></p>
                    <p>Date: <?php echo $date; ?></p> <hr> <br> <br>
                    <p>Authorized Signature: __________________________</p>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo "Execute failed: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Missing POST parameters.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
