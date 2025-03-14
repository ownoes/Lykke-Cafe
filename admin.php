<?php
session_start();
require 'db_connect.php';

// Get the requested page or default to dashboard
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php?page=dashboard">Dashboard</a></li>
            <li><a href="admin.php?page=view_orders">View Orders</a></li>
            <li><a href="admin.php?page=manage_stock">Manage Stock</a></li>
            <li><a href="admin.php?page=sales_report">Sales Reports</a></li>
            <li><a href="admin.php?page=add_supply">Add Supply</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <?php
        $allowed_pages = ['dashboard', 'view_orders', 'manage_stock', 'sales_report', 'add_supply'];
        if (in_array($page, $allowed_pages)) {
            include $page . ".php";
        } else {
            echo "<h2>Page Not Found</h2>";
        }
        ?>
    </div>
</body>
</html>
