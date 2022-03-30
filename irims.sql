-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 30, 2022 at 09:48 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irims`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Supplies'),
(2, 'Equipment');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `DepartmentName`) VALUES
(0, 'Admin'),
(1, 'Library'),
(2, 'Facility Management Office'),
(3, 'Medical Office'),
(4, 'Security Office'),
(5, 'Guidance Office'),
(6, 'Registrar'),
(7, 'Admission Office'),
(8, 'Student Records Office'),
(9, 'Cash Disbursement Office');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Stocks` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `IsDeleted` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Stocks`, `SupplierID`, `CategoryID`, `IsDeleted`) VALUES
(1, 'Scotch Tape', 6, 1, 1, b'0'),
(2, 'Ballpen', 17, 2, 1, b'0'),
(3, 'Notepad', 8, 3, 1, b'0'),
(4, 'Scissor', 10, 4, 1, b'0'),
(5, 'Folder', 10, 5, 1, b'0'),
(6, 'Monitor', 11, 6, 2, b'0'),
(7, 'Printer', 8, 7, 2, b'0'),
(8, 'Telephone', 10, 8, 2, b'0'),
(9, 'Scanner', 9, 9, 2, b'0'),
(10, 'Electric fan', 8, 10, 2, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int(11) NOT NULL,
  `RequestDateTime` datetime NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `RequestDateTime`, `UserID`, `ProductID`, `Quantity`, `Status`) VALUES
(1, '2022-03-28 18:27:13', 1, 2, 1, b'1'),
(2, '2022-03-28 18:27:22', 1, 10, 2, b'0'),
(3, '2022-03-28 18:27:43', 2, 9, 1, b'1'),
(4, '2022-03-28 18:27:58', 3, 1, 2, b'0'),
(5, '2022-03-28 18:28:06', 3, 7, 2, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(200) NOT NULL,
  `ContactNO` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `ContactNO`, `CategoryID`) VALUES
(1, 'Carolina Tape & Supply Corporation', 875612, 1),
(2, 'HBW', 4576221, 1),
(3, 'TJ’S CLEAR ART', 4896523, 1),
(4, 'EVERSHARP PRO COMPANY', 2348758, 1),
(5, 'Ampway', 4576221, 1),
(6, 'Dell', 5129889, 2),
(7, 'Epson', 3927492, 2),
(8, 'Grandstream', 8264021, 2),
(9, 'Acer', 9362947, 2),
(10, 'Hanabishi', 5399153, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `UserPassword` varchar(30) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `ContactNO` int(11) NOT NULL,
  `IsAdmin` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `FirstName`, `LastName`, `UserPassword`, `DepartmentID`, `ContactNO`, `IsAdmin`) VALUES
(0, 'admin', 'adminFN', 'adminLN', 'admin', 0, 0, b'1'),
(1, 'user', 'userFN', 'userLN', 'user', 1, 1, b'0'),
(2, 'paul', 'paul', 'tulod', 'paul', 6, 1234125, b'0'),
(3, 'micah', 'micah', 'tulod', 'micah', 7, 123456789, b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `SupplierFK` (`SupplierID`),
  ADD KEY `CategoryFK` (`CategoryID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `UserFK` (`UserID`),
  ADD KEY `ProductFK` (`ProductID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`),
  ADD KEY `SuppliesCategoryFK` (`CategoryID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `DepartmentFK` (`DepartmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `CategoryFK` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`),
  ADD CONSTRAINT `SupplierFK` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `ProductFK` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `UserFK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `SuppliesCategoryFK` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `DepartmentFK` FOREIGN KEY (`DepartmentID`) REFERENCES `department` (`DepartmentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
