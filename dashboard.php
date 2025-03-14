<?php
require 'db_connect.php';
?>

<h1>Welcome, Admin</h1>
<p>Select an option from the menu.</p>

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
