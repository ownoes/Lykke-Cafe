<?php
require 'db_connect.php';

$sql = "SELECT DATE(o.orderDate) AS orderDate, 
               COALESCE(SUM(oi.quantity * m.price), 0) AS totalSales
        FROM orders o
        LEFT JOIN orderitem oi ON o.orderID = oi.orderID
        LEFT JOIN menuitem m ON oi.menuItemID = m.menuItemID
        WHERE o.paymentStatus = 'Paid'
        GROUP BY DATE(o.orderDate)
        ORDER BY o.orderDate DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Sales Report</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Total Sales (PHP)</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['orderDate'] ?></td>
            <td>PHP <?= number_format($row['totalSales'], 2) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
