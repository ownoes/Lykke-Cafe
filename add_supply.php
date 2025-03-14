<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplierID = $_POST['supplierID'];
    $ingredientID = $_POST['ingredientID'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Start a new transaction
    $sql = "INSERT INTO stocktransaction (supplierID) VALUES ('$supplierID')";
    if ($conn->query($sql)) {
        $transactionID = $conn->insert_id; // Get last inserted ID

        $subtotal = $quantity * $price;
        $sql = "INSERT INTO stockdetails (transactionID, quantitySupply, price, subtotal) 
                VALUES ('$transactionID', '$quantity', '$price', '$subtotal')";
        
        if ($conn->query($sql)) {
            // Update ingredient stock
            $updateSql = "UPDATE ingredient SET quantityOnHand = quantityOnHand + $quantity WHERE ingredientID = '$ingredientID'";
            if ($conn->query($updateSql)) {
                echo "Supply added successfully.";
            } else {
                echo "Error updating ingredient stock: " . $conn->error;
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST">
    <label>Supplier:</label>
    <select name="supplierID" required>
        <?php
        $suppliers = $conn->query("SELECT supplierID, supplierName FROM supplier");
        while ($supplier = $suppliers->fetch_assoc()) {
            echo "<option value='{$supplier['supplierID']}'>{$supplier['supplierName']}</option>";
        }
        ?>
    </select>

    <label>Ingredient:</label>
    <select name="ingredientID" required>
        <?php
        $ingredients = $conn->query("SELECT ingredientID, ingredientName FROM ingredient");
        while ($ingredient = $ingredients->fetch_assoc()) {
            echo "<option value='{$ingredient['ingredientID']}'>{$ingredient['ingredientName']}</option>";
        }
        ?>
    </select>

    <label>Quantity:</label>
    <input type="number" name="quantity" required>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" required>

    <button type="submit">Add Supply</button>
</form>
