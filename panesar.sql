-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2018 at 01:49 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panesar`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE `item_list` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(64) NOT NULL,
  `UNIT` varchar(64) NOT NULL,
  `PHOTO` varchar(64) NOT NULL,
  `COLOR` varchar(64) NOT NULL,
  `MIN_THRESHOLD` double NOT NULL,
  `CURRENT_QTY` double NOT NULL,
  `STATUS` tinyint(4) DEFAULT '1',
  `CREATED_BY` int(10) NOT NULL,
  `CREATED_AT` timestamp(5) NOT NULL DEFAULT CURRENT_TIMESTAMP(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`ID`, `NAME`, `UNIT`, `PHOTO`, `COLOR`, `MIN_THRESHOLD`, `CURRENT_QTY`, `STATUS`, `CREATED_BY`, `CREATED_AT`) VALUES
(1, 'askdoakd', '1', '', '', 223, 0, 1, 1, '2018-07-22 18:44:50.45802'),
(2, 'pen', '3', '', 'red', 10, 0, 1, 1, '2018-08-03 06:51:10.84235'),
(3, 'macbook', '3', '', 'silver', 23, 0, 1, 1, '2018-08-03 06:52:32.74183');

-- --------------------------------------------------------

--
-- Table structure for table `lot_list`
--

CREATE TABLE `lot_list` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `SAMPLE_ID` int(100) NOT NULL,
  `QUANTITY` int(100) NOT NULL,
  `CURRENT_QUANTITY` int(100) NOT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT '1',
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `ID` int(100) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `LOT_ID` int(100) NOT NULL,
  `QUANTITY` int(100) NOT NULL,
  `PRICE` int(100) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `CREATED_BY` tinyint(4) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `samples`
--

CREATE TABLE `samples` (
  `ID` int(10) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT '1',
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_AT` timestamp(5) NOT NULL DEFAULT CURRENT_TIMESTAMP(5) ON UPDATE CURRENT_TIMESTAMP(5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `samples`
--

INSERT INTO `samples` (`ID`, `NAME`, `STATUS`, `CREATED_BY`, `CREATED_AT`) VALUES
(1, 'machine', 1, 1, '2018-08-03 06:52:58.04165');

-- --------------------------------------------------------

--
-- Table structure for table `sample_list`
--

CREATE TABLE `sample_list` (
  `SAMPLE_ID` int(10) NOT NULL,
  `ITEM_ID` int(10) NOT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT '1',
  `QUANTITY` varchar(100) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sample_list`
--

INSERT INTO `sample_list` (`SAMPLE_ID`, `ITEM_ID`, `STATUS`, `QUANTITY`, `CREATED_AT`, `CREATED_BY`) VALUES
(1, 3, 1, '2', '2018-08-03 06:52:58', 1),
(1, 2, 1, '2', '2018-08-03 06:52:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `ID` int(20) NOT NULL,
  `NAME` varchar(20) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_item`
--

CREATE TABLE `stock_item` (
  `ID` int(11) NOT NULL,
  `STOCK_ID` int(11) NOT NULL,
  `ITEM_ID` int(20) NOT NULL,
  `QUANTITY` int(20) NOT NULL,
  `BALANCE` int(100) NOT NULL,
  `RATE` int(20) NOT NULL,
  `STATUS` tinyint(4) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stock_outward`
--

CREATE TABLE `stock_outward` (
  `LOT_ID` int(100) NOT NULL,
  `ITEM_ID` int(100) NOT NULL,
  `QUANTITY` int(100) NOT NULL,
  `RATE` int(100) NOT NULL,
  `STATUS` tinyint(4) NOT NULL DEFAULT '1',
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CREATED_BY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(128) NOT NULL,
  `USERNAME` varchar(64) NOT NULL,
  `PASSWORD` varchar(64) NOT NULL,
  `PHONE_NUMBER` varchar(16) NOT NULL,
  `EMAIL_ID` varchar(128) NOT NULL,
  `SALT` varchar(32) NOT NULL,
  `TYPE` tinyint(1) NOT NULL,
  `CREATED_BY` int(11) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `STATUS` tinyint(1) NOT NULL DEFAULT '1',
  `DELETED_BY` int(11) DEFAULT NULL,
  `DELETED_AT` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `NAME`, `USERNAME`, `PASSWORD`, `PHONE_NUMBER`, `EMAIL_ID`, `SALT`, `TYPE`, `CREATED_BY`, `CREATED_AT`, `STATUS`, `DELETED_BY`, `DELETED_AT`) VALUES
(1, 'Gagandeep Singh', 'gagandeep', 'a2c5c49c75eb08b142ea90a8cba07725d7c6c4d534214e5c6cbb6233b3413cbf', '', '', '279df27e93000e7b', 1, 0, '2018-07-12 07:37:28', 0, NULL, NULL),
(2, 'admin', 'admin', 'ecac031067aa4b50b390378bbf3f0c8da8fe121a6cf97dee9c1617e9913078c0', '', '', 'c5eea9669ee710fa', 1, 1, '2018-12-15 12:44:26', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_list`
--
ALTER TABLE `item_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `lot_list`
--
ALTER TABLE `lot_list`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `samples`
--
ALTER TABLE `samples`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stock_item`
--
ALTER TABLE `stock_item`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_list`
--
ALTER TABLE `item_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lot_list`
--
ALTER TABLE `lot_list`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `samples`
--
ALTER TABLE `samples`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_item`
--
ALTER TABLE `stock_item`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
