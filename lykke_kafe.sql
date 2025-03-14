-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 08:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lykke_kafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Drinks'),
(2, 'Pastry'),
(3, 'Salad'),
(4, 'Pizza'),
(5, 'Pasta'),
(6, 'Rice Meals'),
(7, 'Sandwiches'),
(8, 'Chicken Wings');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employeeID` int(11) NOT NULL,
  `employeeName` varchar(100) NOT NULL,
  `position` varchar(50) DEFAULT NULL,
  `hireDate` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `employeeName`, `position`, `hireDate`, `username`, `password`, `salary`) VALUES
(1, 'Admin', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `ingredientID` int(11) NOT NULL,
  `ingredientName` varchar(100) NOT NULL,
  `quantityOnHand` int(11) DEFAULT 0,
  `supplierID` int(11) DEFAULT NULL,
  `productShelfLife` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredientusage`
--

CREATE TABLE `ingredientusage` (
  `usageID` int(11) NOT NULL,
  `menuItemID` int(11) DEFAULT NULL,
  `ingredientID` int(11) DEFAULT NULL,
  `quantityUsed` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menuitem`
--

CREATE TABLE `menuitem` (
  `menuItemID` int(11) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menuitem`
--

INSERT INTO `menuitem` (`menuItemID`, `itemName`, `categoryID`, `availability`, `price`) VALUES
(1, 'Chicken Tenders in White Sauce', 6, 1, 150.00),
(2, 'Garlic Pepper Beef', 6, 1, 190.00),
(3, 'Grilled Honey Salmon', 6, 1, 230.00),
(4, 'Crispy Pork Kare Kare', 6, 1, 180.00),
(5, 'Smoky BBQ Ribs', 6, 1, 220.00),
(6, 'Pork Binagoongan', 6, 1, 180.00),
(7, 'Truffle White Pasta', 5, 1, 175.00),
(8, 'Chicken Pesto', 5, 1, 180.00),
(9, 'Classic Spaghetti', 5, 1, 165.00),
(10, 'Seafood Aglio Olio', 5, 1, 175.00),
(11, 'Salted Egg', 8, 1, 170.00),
(12, 'Garlic Parmesan', 8, 1, 170.00),
(13, 'Honey Sriracha', 8, 1, 170.00),
(14, 'Buffalo', 8, 1, 170.00),
(15, 'Pepperoni', 4, 1, 260.00),
(16, 'Four Cheese', 4, 1, 240.00),
(17, 'Creamy Spinach', 4, 1, 250.00),
(18, 'Beef & Mushroom', 4, 1, 250.00),
(19, 'Tuna Melt', 7, 1, 195.00),
(20, 'Clubhouse', 7, 1, 195.00),
(21, 'Monte Kristo', 7, 1, 195.00),
(22, 'Korean Egg Drop', 7, 1, 160.00),
(23, 'Mango Pomelo Salad', 3, 1, 150.00),
(24, 'Grilled Chicken Caesar', 3, 1, 160.00),
(25, 'Espresso', 1, 1, 90.00),
(26, 'Americano', 1, 1, 100.00),
(27, 'Doppio', 1, 1, 110.00),
(33, 'Americano', 1, 1, 120.00),
(49, 'Oreo Cookie Croffle', 2, 1, 120.00),
(50, 'Pain Au Chocolat', 2, 1, 100.00),
(51, 'Carbonara', 5, 1, 175.00),
(52, 'Croissant(Plain Butter)', 2, 1, 90.00);

-- --------------------------------------------------------

--
-- Table structure for table `orderitem`
--

CREATE TABLE `orderitem` (
  `orderItemID` int(11) NOT NULL,
  `orderID` int(11) DEFAULT NULL,
  `menuItemID` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderitem`
--

INSERT INTO `orderitem` (`orderItemID`, `orderID`, `menuItemID`, `quantity`) VALUES
(1, 2, 8, 2),
(2, 2, 49, 1),
(3, 4, 49, 1),
(4, 4, 8, 1),
(5, 6, 16, 1),
(6, 7, 7, 1),
(7, 8, 49, 1),
(8, 9, 49, 1),
(9, 10, 8, 1),
(10, 11, 25, 1),
(11, 17, 51, 1),
(12, 18, 8, 1),
(13, 19, 8, 1),
(14, 20, 8, 1),
(15, 21, 8, 1),
(16, 22, 8, 1),
(17, 23, 8, 1),
(18, 29, 50, 1),
(19, 31, 52, 1),
(20, 32, 8, 1),
(21, 32, 16, 1),
(22, 41, 8, 1),
(23, 42, 8, 1),
(24, 43, 8, 1),
(25, 44, 8, 2),
(26, 45, 8, 2),
(27, 46, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `orderDate` datetime DEFAULT current_timestamp(),
  `paymentStatus` enum('Pending','Paid','Cancelled') DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `orderDate`, `paymentStatus`, `employeeID`) VALUES
(2, '2025-03-11 20:55:06', 'Pending', 1),
(3, '2025-03-11 20:57:44', 'Pending', 1),
(4, '2025-03-11 20:57:56', 'Pending', 1),
(5, '2025-03-11 21:06:32', 'Pending', 1),
(6, '2025-03-11 21:06:44', 'Paid', 1),
(7, '2025-03-11 21:20:27', 'Paid', 1),
(8, '2025-03-11 21:57:20', 'Paid', 1),
(9, '2025-03-11 21:57:41', 'Paid', 1),
(10, '2025-03-11 21:58:36', 'Paid', 1),
(11, '2025-03-11 22:00:20', 'Paid', 1),
(12, '2025-03-11 22:01:32', 'Paid', 1),
(13, '2025-03-11 22:01:47', 'Paid', 1),
(14, '2025-03-11 22:01:51', 'Paid', 1),
(15, '2025-03-11 22:01:52', 'Paid', 1),
(16, '2025-03-11 22:01:59', 'Cancelled', 1),
(17, '2025-03-11 22:02:04', 'Cancelled', 1),
(18, '2025-03-11 22:02:22', 'Paid', 1),
(19, '2025-03-11 22:02:34', 'Paid', 1),
(20, '2025-03-11 22:03:06', 'Paid', 1),
(21, '2025-03-11 22:05:06', 'Paid', 1),
(22, '2025-03-11 23:17:29', 'Paid', 1),
(23, '2025-03-12 14:31:22', 'Cancelled', 1),
(24, '2025-03-12 14:34:28', 'Pending', 1),
(25, '2025-03-12 14:34:29', 'Pending', 1),
(26, '2025-03-12 14:34:30', 'Pending', 1),
(27, '2025-03-12 14:34:32', 'Pending', 1),
(28, '2025-03-12 14:34:33', 'Pending', 1),
(29, '2025-03-12 14:36:57', 'Pending', 1),
(30, '2025-03-12 14:37:37', 'Pending', 1),
(31, '2025-03-12 14:37:51', 'Pending', 1),
(32, '2025-03-12 15:20:28', 'Paid', 1),
(33, '2025-03-12 16:41:47', 'Pending', 1),
(34, '2025-03-12 16:41:48', 'Pending', 1),
(35, '2025-03-12 16:41:49', 'Pending', 1),
(36, '2025-03-12 16:41:49', 'Pending', 1),
(37, '2025-03-12 16:41:49', 'Pending', 1),
(38, '2025-03-12 16:41:50', 'Pending', 1),
(39, '2025-03-12 16:41:50', 'Pending', 1),
(40, '2025-03-12 16:55:17', 'Pending', 1),
(41, '2025-03-12 16:55:21', 'Paid', 1),
(42, '2025-03-14 05:55:22', 'Paid', 1),
(43, '2025-03-14 05:56:04', 'Paid', 1),
(44, '2025-03-14 06:02:28', 'Paid', 1),
(45, '2025-03-14 06:19:55', 'Paid', 1),
(46, '2025-03-14 15:47:48', 'Pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productwaste`
--

CREATE TABLE `productwaste` (
  `wasteID` int(11) NOT NULL,
  `wasteDate` date DEFAULT curdate(),
  `ingredientID` int(11) DEFAULT NULL,
  `quantityDiscarded` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stockdetails`
--

CREATE TABLE `stockdetails` (
  `stockDetailsID` int(11) NOT NULL,
  `transactionID` int(11) DEFAULT NULL,
  `quantitySupply` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocktransaction`
--

CREATE TABLE `stocktransaction` (
  `transactionID` int(11) NOT NULL,
  `transactionDate` datetime DEFAULT current_timestamp(),
  `supplierID` int(11) DEFAULT NULL,
  `employeeID` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `supplierName` varchar(100) NOT NULL,
  `contactNumber` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `supplierName`, `contactNumber`, `email`) VALUES
(1, 'Coffee Supplier Inc.', '09123456789', 'coffee@supplier.com'),
(2, 'Sweet Treats Co.', '09234567890', 'sweets@supplier.com'),
(3, 'Fresh Meat Supply', '09345678901', 'meat@supplier.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`ingredientID`),
  ADD KEY `supplierID` (`supplierID`);

--
-- Indexes for table `ingredientusage`
--
ALTER TABLE `ingredientusage`
  ADD PRIMARY KEY (`usageID`),
  ADD KEY `menuItemID` (`menuItemID`),
  ADD KEY `ingredientID` (`ingredientID`);

--
-- Indexes for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD PRIMARY KEY (`menuItemID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indexes for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD PRIMARY KEY (`orderItemID`),
  ADD KEY `orderID` (`orderID`),
  ADD KEY `menuItemID` (`menuItemID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Indexes for table `productwaste`
--
ALTER TABLE `productwaste`
  ADD PRIMARY KEY (`wasteID`),
  ADD KEY `ingredientID` (`ingredientID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Indexes for table `stockdetails`
--
ALTER TABLE `stockdetails`
  ADD PRIMARY KEY (`stockDetailsID`),
  ADD KEY `transactionID` (`transactionID`);

--
-- Indexes for table `stocktransaction`
--
ALTER TABLE `stocktransaction`
  ADD PRIMARY KEY (`transactionID`),
  ADD KEY `supplierID` (`supplierID`),
  ADD KEY `employeeID` (`employeeID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `ingredientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredientusage`
--
ALTER TABLE `ingredientusage`
  MODIFY `usageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menuitem`
--
ALTER TABLE `menuitem`
  MODIFY `menuItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `orderitem`
--
ALTER TABLE `orderitem`
  MODIFY `orderItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `productwaste`
--
ALTER TABLE `productwaste`
  MODIFY `wasteID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockdetails`
--
ALTER TABLE `stockdetails`
  MODIFY `stockDetailsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocktransaction`
--
ALTER TABLE `stocktransaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE SET NULL;

--
-- Constraints for table `ingredientusage`
--
ALTER TABLE `ingredientusage`
  ADD CONSTRAINT `ingredientusage_ibfk_1` FOREIGN KEY (`menuItemID`) REFERENCES `menuitem` (`menuItemID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ingredientusage_ibfk_2` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`) ON DELETE CASCADE;

--
-- Constraints for table `menuitem`
--
ALTER TABLE `menuitem`
  ADD CONSTRAINT `menuitem_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`categoryID`) ON DELETE SET NULL;

--
-- Constraints for table `orderitem`
--
ALTER TABLE `orderitem`
  ADD CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderID`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`menuItemID`) REFERENCES `menuitem` (`menuItemID`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE SET NULL;

--
-- Constraints for table `productwaste`
--
ALTER TABLE `productwaste`
  ADD CONSTRAINT `productwaste_ibfk_1` FOREIGN KEY (`ingredientID`) REFERENCES `ingredient` (`ingredientID`) ON DELETE CASCADE,
  ADD CONSTRAINT `productwaste_ibfk_2` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE SET NULL;

--
-- Constraints for table `stockdetails`
--
ALTER TABLE `stockdetails`
  ADD CONSTRAINT `stockdetails_ibfk_1` FOREIGN KEY (`transactionID`) REFERENCES `stocktransaction` (`transactionID`) ON DELETE CASCADE;

--
-- Constraints for table `stocktransaction`
--
ALTER TABLE `stocktransaction`
  ADD CONSTRAINT `stocktransaction_ibfk_1` FOREIGN KEY (`supplierID`) REFERENCES `supplier` (`supplierID`) ON DELETE SET NULL,
  ADD CONSTRAINT `stocktransaction_ibfk_2` FOREIGN KEY (`employeeID`) REFERENCES `employee` (`employeeID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
