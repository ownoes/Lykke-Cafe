<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Handle preflight (OPTIONS) request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Database connection
require 'db_connect.php';

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Database connection failed!", "error" => $conn->connect_error]);
    exit;
}

// Read JSON request
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Debugging: Log the received JSON
file_put_contents("debug_log.txt", "Raw JSON:\n" . $rawData . "\n", FILE_APPEND);

if (!isset($data['cart']) || empty($data['cart'])) {
    echo json_encode(["success" => false, "message" => "Cart is empty."]);
    exit;
}

// ✅ Step 1: Validate Employee ID
$employeeID = 1; // Change this if employees log in

// Check if the employee exists
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

// ✅ Step 2: Insert Order
$sql_order = "INSERT INTO orders (paymentStatus, employeeID) VALUES ('Pending', ?)";
$stmt = $conn->prepare($sql_order);
$stmt->bind_param("i", $employeeID);

if ($stmt->execute()) {
    $orderID = $stmt->insert_id; // Get newly created orderID
} else {
    echo json_encode(["success" => false, "message" => "Order insertion failed!", "error" => $stmt->error]);
    exit;
}

// ✅ Step 3: Insert Each Item Into `orderitem`
$sql_orderitem = "INSERT INTO orderitem (orderID, menuItemID, quantity) VALUES (?, ?, ?)";
$stmt_item = $conn->prepare($sql_orderitem);

foreach ($data['cart'] as $item) {
    if (!isset($item['name']) || !isset($item['quantity'])) {
        echo json_encode(["success" => false, "message" => "Invalid item data."]);
        exit;
    }

    // ✅ Get `menuItemID` from `menuitem`
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

    // ✅ Insert into `orderitem`
    $stmt_item->bind_param("iii", $orderID, $menuItemID, $item['quantity']);
    if (!$stmt_item->execute()) {
        echo json_encode(["success" => false, "message" => "Failed to insert order item!", "error" => $stmt_item->error]);
        exit;
    }
}

// ✅ Step 4: Return Success Response
echo json_encode(["success" => true, "message" => "Order placed successfully!", "orderID" => $orderID]);

// Close Statements & Connection
$stmt->close();
$stmt_item->close();
$conn->close();
?>
