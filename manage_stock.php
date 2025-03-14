<?php
require 'db_connect.php';

// Fetch stock details
$sql_stock = "SELECT sd.stockDetailsID, sd.transactionID, st.transactionDate, 
                      sd.quantitySupply, sd.price, sd.subtotal, 
                      s.supplierName 
               FROM stockdetails sd
               JOIN stocktransaction st ON sd.transactionID = st.transactionID
               JOIN supplier s ON st.supplierID = s.supplierID
               ORDER BY st.transactionDate DESC";

$result_stock = $conn->query($sql_stock);
if (!$result_stock) {
    die("Query failed: " . $conn->error);
}

// Fetch current ingredient stock levels
$sql_ingredients = "SELECT ingredientID, ingredientName, quantityOnHand FROM ingredient ORDER BY ingredientName";
$result_ingredients = $conn->query($sql_ingredients);
if (!$result_ingredients) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Manage Stock</h2>
    <table>
        <tr>
            <th>Stock ID</th>
            <th>Transaction Date</th>
            <th>Supplier</th>
            <th>Quantity</th>
            <th>Price (PHP)</th>
            <th>Subtotal (PHP)</th>
        </tr>
        <?php while ($row = $result_stock->fetch_assoc()): ?>
        <tr>
            <td><?= $row['stockDetailsID'] ?></td>
            <td><?= $row['transactionDate'] ?></td>
            <td><?= $row['supplierName'] ?></td>
            <td><?= $row['quantitySupply'] ?></td>
            <td>PHP <?= number_format($row['price'], 2) ?></td>
            <td>PHP <?= number_format($row['subtotal'], 2) ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <h2>Current Ingredient Stock</h2>
    <table>
        <tr>
            <th>Ingredient ID</th>
            <th>Ingredient Name</th>
            <th>Quantity On Hand</th>
        </tr>
        <?php while ($row = $result_ingredients->fetch_assoc()): ?>
        <tr>
            <td><?= $row['ingredientID'] ?></td>
            <td><?= $row['ingredientName'] ?></td>
            <td><?= $row['quantityOnHand'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>