<?php
require 'db_connect.php';

// Handle Order Status Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orderID'], $_POST['status'])) {
    $orderID = intval($_POST['orderID']);
    $status = $_POST['status'];

    $updateQuery = "UPDATE orders SET paymentStatus = ? WHERE orderID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("si", $status, $orderID);
    $stmt->execute();
    $stmt->close();
}

// Fetch Orders
$sql = "SELECT o.orderID, o.orderDate, o.paymentStatus, e.employeeName 
        FROM orders o
        LEFT JOIN employee e ON o.employeeID = e.employeeID
        ORDER BY o.orderDate DESC";

$result = $conn->query($sql);
?>

<h2>View Orders</h2>
<table>
    <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Status</th>
        <th>Employee</th>
        <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['orderID'] ?></td>
        <td><?= $row['orderDate'] ?></td>
        <td><?= $row['paymentStatus'] ?></td>
        <td><?= $row['employeeName'] ?? 'N/A' ?></td>
        <td>
            <form method="POST">
                <input type="hidden" name="orderID" value="<?= $row['orderID'] ?>">
                <select name="status">
                    <option value="Pending" <?= ($row['paymentStatus'] == "Pending") ? "selected" : "" ?>>Pending</option>
                    <option value="Paid" <?= ($row['paymentStatus'] == "Paid") ? "selected" : "" ?>>Paid</option>
                    <option value="Cancelled" <?= ($row['paymentStatus'] == "Cancelled") ? "selected" : "" ?>>Cancelled</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
