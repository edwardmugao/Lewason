 <!DOCTYPE html>
<html lang="en">
<head>
   
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <title>Lewason Poultry Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-feather"></i>
                <h2>Lewason Poultry</h2>
            </div>
            
            <button class="tablinks active" data-tab="dashboard">
                <i class="fas fa-house"></i> Dashboard
            </button>
            
            <button class="tablinks" data-tab="employees">
                <i class="fas fa-user-plus"></i> Employees Registration
            </button>
            
            <button class="tablinks" data-tab="products">
                <i class="fas fa-cart-flatbed-suitcase"></i> Products Registration
            </button>
            
            <button class="tablinks" data-tab="health-records">
                <i class="fas fa-notes-medical"></i> Health Records
            </button>

            <button class="tablinks" data-tab="supplier-records">
                <i class="fas fa-truck"></i> Supplier Management
            </button>

            <button class="tablinks" data-tab="payments">
                <i class="fas fa-credit-card"></i> Payments Management
            </button>
            
            <button class="tablinks" data-tab="paybills">
                <i class="fas fa-money-bill-transfer"></i> Customer Orders
            </button>

            <button class="tablinks" data-tab="totalbirds">
                <i class="fas fa-dove"></i> Total Birds
            </button>
            
            <form action="logout.php" method="post">
                <button type="submit" class="tablinks">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="fixed-header">
                <div class="header-controls">
                    <button class="btn btn-primary" disabled id="currentDate"></button>
                    <button class="btn btn-primary" disabled id="clock"></button>
                    <button id="modeToggle" class="btn btn-warning">Toggle Dark Mode</button>
                    <button id="refreshPage" class="btn btn-info">Refresh Page</button>
                    <button id="resetForms" class="btn btn-primary">Reset Forms</button>
                   <button class=" btn btn-info" onclick="window.location.href='search_all.php'">Search Info</button>
                    

                    
                </div>
            </div>

            <!-- Dashboard Tab -->
                <?php include 'dashboard.php'; ?>
            <div id="dashboard" class="tabcontent" style="display: block;">
            <div class="dashboard-flex-container">

                <div class="card text-center">
                <div class="icon text-primary"><i class="fas fa-users fa-2x"></i></div>
                <h2 class="text-primary"><?php echo $totalEmployees; ?></h2>
                <p>Employees</p>
                </div>

                <div class="card text-center">
                <div class="icon text-success"><i class="fas fa-box-open fa-2x"></i></div>
                <h2 class="text-success"><?php echo $totalProducts; ?></h2>
                <p>Products</p>
                </div>

                <div class="card text-center">
                <div class="icon text-warning"><i class="fas fa-shopping-cart fa-2x"></i></div>
                <h2 class="text-warning"><?php echo $totalOrders; ?></h2>
                <p>Customer Orders</p>
                </div>

                <div class="card text-center">
                <div class="icon text-danger"><i class="fas fa-dove fa-2x"></i></div>
                <h2 class="text-danger"><?php echo $totalBirds; ?></h2>
                <p>Total Birds</p>
                </div>
            </div> 
            </div>

 
            <!-- Employees Tab -->
            <div id="employees" class="tabcontent">
                <div class="form-container">
                    <h2><i class="fas fa-user-plus"></i> Employee Registration</h2>
                    <form id="employeeForm" action="employees.php" method="POST">
                        <div class="form-group">
                            <label>Worker ID</label>
                            <input type="text" name="worker_id" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Worker Type</label>
                            <select name="worker_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option>Manager</option>
                                <option>Supervisor</option>
                                <option>Director</option>
                                <option>Casual Worker</option>
                            </select>
                        </div>

                         <div class="form-group">
                        <label>Salary</label>
                        <input type="number" name="salary" class="form-control" min="0" step="1000" required>
                    </div>

                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Register Worker
                        </button>
                    </form>
                </div>
            </div>

            <!-- Products Tab -->
            <div id="products" class="tabcontent">
                <div class="form-container">
                    <h2><i class="fas fa-box"></i> Product Registration</h2>
                    <form action="prod.php" method="POST">
                        <div class="form-group">
                            <label>Product ID</label>
                            <input type="text" name="product_id" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Price (Ksh)</label>
                            <input type="number" name="price" step="0.01" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Registered By</label>
                            <input type="text" name="registered_by" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Register Product
                        </button>
                    </form>
                </div>
            </div>

            <!-- Health Records Tab -->
            <div id="health-records" class="tabcontent">
                <div class="form-container">
                    <h2><i class="fas fa-notes-medical"></i> Poultry Health Records</h2>
                    <form action="health_records.php" method="POST">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="record_date" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Type of Record</label>
                            <select name="record_type" class="form-control" required>
                                <option value="">Select Type</option>
                                <option>Vaccination</option>
                                <option>Disease Outbreak</option>
                                <option>Mortality</option>
                                <option>Medical Treatment</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Staff Responsible</label>
                            <input type="text" name="staff" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Save Record
                        </button>
                    </form>
                </div>
            </div>

            <!-- Supplier Management Tab -->
            <div id="supplier-records" class="tabcontent">
                <div class="form-container">
                    <h2><i class="fas fa-truck"></i> Supplier Management</h2>
                    <form action="supplier_records.php" method="POST">
                        <div class="form-group">
                            <label>Supplier Name</label>
                            <input type="text" name="supplier_name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Contact Info</label>
                            <input type="text" name="contact_info" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Items Supplied</label>
                            <textarea name="items_supplied" class="form-control" rows="3" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Delivery Date</label>
                            <input type="date" name="delivery_date" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Save Supplier
                        </button>
                    </form>
                </div>
            </div>

            <!-- Payments Tab -->
             <!-- Payments Tab -->
<div id="payments" class="tabcontent">
    <div class="form-container">
        <h2><i class="fas fa-credit-card"></i> Payment Details</h2>
        <form id="paymentForm" action="payment.php" method="POST" target="_blank">
            <div class="form-group">
                <label>Payee</label>
                <input type="text" id="payee" name="payee" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Amount (Ksh)</label>
                <input type="number" id="amount" name="amount" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Service</label>
                <input type="text" id="service" name="service" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Bank</label>
                <input type="text" id="bank" name="bank" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Account Number</label>
                <input type="text" id="account" name="account" class="form-control" required>
            </div>
            
            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Submit Payment & Generate Docs
            </button>
        </form>
    </div>
</div>


            <!-- Customer Orders Tab -->
            <div id="paybills" class="tabcontent">
                <div class="form-container">
                    <h2><i class="fas fa-shopping-cart"></i> Customer Orders</h2>
                    <form action="customer_order.php" method="POST">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Customer ID</label>
                            <input type="text" name="customer_id" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Product ID</label>
                            <input type="text" name="product_id" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" min="1" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Order Status</label>
                            <select name="order_status" class="form-control" required>
                                <option value="Pending">Pending</option>
                                <option value="Processing">Processing</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Payment Amount (Ksh)</label>
                            <input type="number" name="payment_amount" step="0.01" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-check-circle"></i> Submit Order
                        </button>
                    </form>
                </div>
            </div>

            <!-- Total Birds Tab -->
            <div id="totalbirds" class="tabcontent">
                <div class="form-container">
                    <h2><i class="fas fa-dove"></i> Record Poultry Birds</h2>
                    <form action="birds_record.php" method="POST">
                        <div class="form-group">
                            <label>Poultry Type</label>
                            <input type="text" name="poultry_type" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Recorded By</label>
                            <input type="text" name="recorded_by" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Record Birds
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>




<!-- Optional JS to Toggle Tab Content -->
<script>
  document.querySelectorAll('.tablinks').forEach(button => {
    button.addEventListener('click', () => {
      const tab = button.getAttribute('data-tab');

      // Hide all tab contents
      document.querySelectorAll('.tabcontent').forEach(tc => {
        tc.style.display = 'none';
      });

      // Show selected tab
      document.getElementById(tab).style.display = 'block';

      // Remove active from all buttons, then activate clicked one
      document.querySelectorAll('.tablinks').forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
    });
  });
</script>
 

<div class="search-bar">
    <input type="text" id="searchInput" placeholder="Search by name, email, or position">
    <button onclick="resetSearch()">Reset</button>
</div>

<!-- This is your tabcontent container where results should appear -->
<div class="tabcontent"></div>

<script>
    const searchInput = document.getElementById("searchInput");
    // Select the first element with class "tabcontent"
    const resultDiv = document.querySelector(".tabcontent");

    searchInput.addEventListener("keyup", function () {
        const query = searchInput.value.trim();

        if (query.length > 0) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "search.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    resultDiv.innerHTML = xhr.responseText;
                }
            };

            xhr.send("query=" + encodeURIComponent(query));
        } else {
            resultDiv.innerHTML = ""; // Clear results if empty input
        }
    });

    function resetSearch() {
        searchInput.value = "";
        resultDiv.innerHTML = "";
        searchInput.focus();
    }
</script>










<script src="eduh.js"></script>
</body>
</html>