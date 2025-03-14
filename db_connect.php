<?php
// Check if the request is coming from an API endpoint
if (strpos($_SERVER['REQUEST_URI'], 'api') !== false || strpos($_SERVER['REQUEST_URI'], 'process_order.php') !== false) {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "lykke_kafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
