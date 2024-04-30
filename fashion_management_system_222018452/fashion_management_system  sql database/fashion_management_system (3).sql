-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2024 at 01:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashion_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Email`, `Address`) VALUES
(1, 'nelly', 'nelly@gmail.com', 'gasabo'),
(2, 'peter', 'peter@gmail.com', 'kayonza'),
(3, 'urujene23', 'urujene@gmail.com', 'nyanza'),
(4, 'grilish', 'grilish@gmail.com', 'english'),
(5, 'foden67', 'foden@gmail.com', 'england'),
(6, 'MWAN', 'mwana@gmail.com', 'huye');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Position` varchar(100) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeID`, `Name`, `Position`, `Salary`, `Gender`) VALUES
(3, 'Theo', 'Manager', '500.00', 'Male'),
(4, 'Kamaliza6', 'Account', '700.00', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `OrderDate`, `TotalAmount`) VALUES
(1, 1, '2008-03-12', '45000.00'),
(3, 2, '2022-03-19', '10000.00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `SupplierID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `Name`, `Description`, `Price`, `SupplierID`) VALUES
(5, 'innocent', 'munezero', '78986443.00', 3),
(6, 'innocent', 'munezero', '78986443.00', 3),
(7, 'manzi', 'kdb', '6700.00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplierID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Contact` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Gendar` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplierID`, `Name`, `Contact`, `Email`, `Gendar`) VALUES
(1, 'Rose', 'rose@gmail.com', '0787412363', 'Female'),
(2, 'David', 'david@gmail.com', '0791434760', 'Male'),
(3, 'errrrrre', 'fffgggg', 'rdghj', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'Alice', 'UWAMARIYA', '222018452', 'alice@gmail.com', '0791434760', '$2y$10$InvZKTaXh.7TgFjLSd.UD.S3OsytGKDQGtaHF2hKyn6cfDkLrVXTy', '2024-04-27 22:02:24', '65', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `SupplierID` (`SupplierID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplierID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`supplierID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
