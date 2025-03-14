<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require 'db_connect.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed!", "error" => $conn->connect_error]);
    exit;
}

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

file_put_contents("debug_log.txt", "Raw JSON:\n" . $rawData . "\n", FILE_APPEND);

if (!isset($data['cart']) || empty($data['cart'])) {
    echo json_encode(["success" => false, "message" => "Cart is empty."]);
    exit;
}

$employeeID = 1; // Change this if employees log in

$checkEmployee = "SELECT employeeID FROM employee WHERE employeeID = ?";
$stmt_emp = $conn->prepare($checkEmployee);
$stmt_emp->bind_param("i", $employeeID);
$stmt_emp->execute();
$stmt_emp->store_result();

if ($stmt_emp->num_rows === 0) {
    echo json_encode(["success" => false, "message" => "Invalid employee ID."]);
    exit;
}
$stmt_emp->close();

$sql_order = "INSERT INTO orders (paymentStatus, employeeID) VALUES ('Pending', ?)";
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("i", $employeeID);

if ($stmt->execute()) {
    $orderID = $stmt->insert_id;
} else {
    echo json_encode(["success" => false, "message" => "Order insertion failed!", "error" => $stmt->error]);
    exit;
}

$sql_orderitem = "INSERT INTO orderitem (orderID, menuItemID, quantity) VALUES (?, ?, ?)";
$stmt_item = $conn->prepare($sql_orderitem);

foreach ($data['cart'] as $item) {
    if (!isset($item['name']) || !isset($item['quantity'])) {
        echo json_encode(["success" => false, "message" => "Invalid item data."]);
        exit;
    }

    $menuItemQuery = "SELECT menuItemID FROM menuitem WHERE itemName = ?";
    $stmt_menu = $conn->prepare($menuItemQuery);
    $stmt_menu->bind_param("s", $item['name']);
    $stmt_menu->execute();
    $stmt_menu->bind_result($menuItemID);
    $stmt_menu->fetch();
    $stmt_menu->close();

    if (!$menuItemID) {
        echo json_encode(["success" => false, "message" => "Menu item not found: " . $item['name']]);
        exit;
    }

    $stmt_item->bind_param("iii", $orderID, $menuItemID, $item['quantity']);
    if (!$stmt_item->execute()) {
        echo json_encode(["success" => false, "message" => "Failed to insert order item!", "error" => $stmt_item->error]);
        exit;
    }

    // ✅ Deduct ingredient usage from stock
    $ingredientQuery = "SELECT ingredientID, quantityUsed FROM ingredientusage WHERE menuItemID = ?";
    $stmt_ing = $conn->prepare($ingredientQuery);
    $stmt_ing->bind_param("i", $menuItemID);
    $stmt_ing->execute();
    $stmt_ing->bind_result($ingredientID, $quantityUsed);

    while ($stmt_ing->fetch()) {
        $totalUsage = $quantityUsed * $item['quantity'];

        $updateStock = "UPDATE stockdetails SET quantity = GREATEST(quantity - ?, 0) WHERE ingredientID = ?";
        $stmt_stock = $conn->prepare($updateStock);
        $stmt_stock->bind_param("di", $totalUsage, $ingredientID);
        $stmt_stock->execute();
        $stmt_stock->close();
    }
    $stmt_ing->close();
}

echo json_encode(["success" => true, "message" => "Order placed successfully!", "orderID" => $orderID]);

$stmt->close();
$stmt_item->close();
$conn->close();
?>
