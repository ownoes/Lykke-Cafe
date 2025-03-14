
<?php
require 'db_connect.php';

$sql = "SELECT * FROM ingredient";
$result = $conn->query($sql);
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
            <th>Ingredient</th>
            <th>Quantity</th>
            <th>Supplier</th>
            <th>Product Shelf Life</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['ingredientName'] ?></td>
            <td><?= $row['quantityOnHand'] ?></td>
            <td><?= $row['supplierID'] ?></td>
            <td><?= $row['productShelfLife'] ?> days</td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
