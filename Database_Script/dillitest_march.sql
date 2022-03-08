-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2022 at 04:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dillitest_march`
--
DROP DATABASE IF EXISTS `dillitest_march`;
CREATE DATABASE IF NOT EXISTS `dillitest_march` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dillitest_march`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `user_email`, `pwd`, `is_active`) VALUES
(1, 'dilliadmin@gmail.com', '25d55ad283aa400af464c76d713c07ad', '1');

-- --------------------------------------------------------

--
-- Table structure for table `files_plans`
--

DROP TABLE IF EXISTS `files_plans`;
CREATE TABLE `files_plans` (
  `id` int(11) NOT NULL,
  `capacity` int(11) NOT NULL DEFAULT 0,
  `m_amount` decimal(15,2) NOT NULL,
  `y_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files_plans`
--

INSERT INTO `files_plans` (`id`, `capacity`, `m_amount`, `y_amount`) VALUES
(1, 10000, '7.00', '60.00'),
(2, 25000, '15.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `storage_plans`
--

DROP TABLE IF EXISTS `storage_plans`;
CREATE TABLE `storage_plans` (
  `id` int(11) NOT NULL,
  `capacity` decimal(15,2) NOT NULL DEFAULT 0.00,
  `m_amount` decimal(15,2) NOT NULL,
  `y_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storage_plans`
--

INSERT INTO `storage_plans` (`id`, `capacity`, `m_amount`, `y_amount`) VALUES
(1, '1.00', '8.00', '75.00'),
(2, '2.00', '15.00', '150.00'),
(3, '5.00', '40.00', '200.00'),
(4, '10.00', '60.00', '300.00'),
(5, '25.00', '80.00', '400.00'),
(6, '50.00', '100.00', '600.00'),
(7, '100.00', '170.00', '1000.00');

-- --------------------------------------------------------

--
-- Table structure for table `unlimited_plans`
--

DROP TABLE IF EXISTS `unlimited_plans`;
CREATE TABLE `unlimited_plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(100) NOT NULL,
  `m_amount` decimal(15,2) NOT NULL,
  `y_amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unlimited_plans`
--

INSERT INTO `unlimited_plans` (`id`, `plan_name`, `m_amount`, `y_amount`) VALUES
(1, 'Files', '500.00', '3000.00'),
(2, 'Storage', '500.00', '4500.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd` varchar(200) NOT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT '1',
  `w_balance` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pwd`, `is_active`, `w_balance`) VALUES
(1, 'user1@gmail.com', '25d55ad283aa400af464c76d713c07ad', '1', '4540.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart_details`
--

DROP TABLE IF EXISTS `user_cart_details`;
CREATE TABLE `user_cart_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_details` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

DROP TABLE IF EXISTS `user_orders`;
CREATE TABLE `user_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `items_price` decimal(15,2) NOT NULL,
  `order_dt` datetime NOT NULL,
  `discount` decimal(15,2) NOT NULL,
  `tax_amount` decimal(15,2) NOT NULL,
  `grand_total` decimal(15,2) NOT NULL,
  `tax_percent` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`id`, `user_id`, `items_price`, `order_dt`, `discount`, `tax_amount`, `grand_total`, `tax_percent`) VALUES
(27, 1, '300.00', '2022-03-07 21:44:00', '0.00', '60.00', '360.00', '20.00'),
(28, 1, '7500.00', '2022-03-07 21:45:00', '750.00', '1350.00', '8100.00', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_order_details`
--

DROP TABLE IF EXISTS `user_order_details`;
CREATE TABLE `user_order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `validity` varchar(100) NOT NULL,
  `transaction_dt` datetime NOT NULL,
  `item_capacity` varchar(100) NOT NULL,
  `item_amount` decimal(15,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_order_details`
--

INSERT INTO `user_order_details` (`id`, `order_id`, `item_name`, `validity`, `transaction_dt`, `item_capacity`, `item_amount`, `qty`) VALUES
(28, 27, 'Storage', 'Yearly', '2022-03-07 21:44:00', '5 GB', '200.00', 1),
(29, 27, 'Files', 'Yearly', '2022-03-07 21:44:00', '25,000 Files', '100.00', 1),
(30, 28, 'Storage', 'Yearly', '2022-03-07 21:45:00', 'Unlimited GB', '4500.00', 1),
(31, 28, 'Files', 'Yearly', '2022-03-07 21:45:00', 'Unlimited Files', '3000.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_balance_history`
--

DROP TABLE IF EXISTS `wallet_balance_history`;
CREATE TABLE `wallet_balance_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `amount` decimal(15,2) NOT NULL,
  `type` varchar(100) NOT NULL,
  `transaction_dt` datetime NOT NULL,
  `description` varchar(1000) NOT NULL,
  `balance` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet_balance_history`
--

INSERT INTO `wallet_balance_history` (`id`, `user_id`, `amount`, `type`, `transaction_dt`, `description`, `balance`) VALUES
(21, 1, '3000.00', 'Added To Wallet', '2022-03-07 21:43:00', 'Amount Added Wallet', '3000.00'),
(22, 1, '360.00', 'Purchase', '2022-03-07 21:44:00', 'Purchase Order Id -27', '2640.00'),
(23, 1, '10000.00', 'Added To Wallet', '2022-03-07 21:44:00', 'Amount Added Wallet', '12640.00'),
(24, 1, '8100.00', 'Purchase', '2022-03-07 21:45:00', 'Purchase Order Id -28', '4540.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files_plans`
--
ALTER TABLE `files_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storage_plans`
--
ALTER TABLE `storage_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unlimited_plans`
--
ALTER TABLE `unlimited_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cart_details`
--
ALTER TABLE `user_cart_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order_details`
--
ALTER TABLE `user_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_balance_history`
--
ALTER TABLE `wallet_balance_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files_plans`
--
ALTER TABLE `files_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `storage_plans`
--
ALTER TABLE `storage_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `unlimited_plans`
--
ALTER TABLE `unlimited_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cart_details`
--
ALTER TABLE `user_cart_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_order_details`
--
ALTER TABLE `user_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wallet_balance_history`
--
ALTER TABLE `wallet_balance_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
