
<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ingredientID = $_POST['ingredientID'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $conn->query("UPDATE ingredient SET quantityOnHand = quantityOnHand + $quantity WHERE ingredientID = $ingredientID");

    $conn->query("INSERT INTO stocktransaction (supplierID, employeeID, total) VALUES (NULL, NULL, $price * $quantity)");
    $transactionID = $conn->insert_id;

    $conn->query("INSERT INTO stockdetails (transactionID, quantitySupply, price, subtotal) VALUES ($transactionID, $quantity, $price, $price * $quantity)");

    header("Location: manage_stock.php");
    exit();
}

$ingredients = $conn->query("SELECT * FROM ingredient");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Add Supply</h2>
    <form method="POST">
        <label>Ingredient:</label>
        <select name="ingredientID">
            <?php while ($row = $ingredients->fetch_assoc()): ?>
            <option value="<?= $row['ingredientID'] ?>"><?= $row['ingredientName'] ?></option>
            <?php endwhile; ?>
        </select>
        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        <label>Price per Unit:</label>
        <input type="number" step="0.01" name="price" required>
        <button type="submit">Add Supply</button>
    </form>
</body>
</html>
