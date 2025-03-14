<?php
session_start();
require 'db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="view_orders.php">View Orders</a></li>
            <li><a href="manage_stock.php">Manage Stock</a></li>
            <li><a href="sales_report.php">View Sales Reports</a></li>
            <li><a href="add_supply.php">Add Supply</a></li>
        </ul>
    </div>
    <div class="admin-content">
        <h1>Welcome, Admin</h1>
        <p>Select an option from the menu.</p>

        <!-- Display Recent Orders -->
        <h2>Recent Orders</h2>
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Payment Status</th>
            </tr>
            <?php
            $result = $conn->query("SELECT orderID, orderDate, paymentStatus FROM orders ORDER BY orderDate DESC LIMIT 5");

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['orderID']}</td>
                            <td>{$row['orderDate']}</td>
                            <td>{$row['paymentStatus']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No recent orders.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
