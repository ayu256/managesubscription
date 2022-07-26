-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2022 at 02:53 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manage_subscription`
--

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `subscription_id` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `role`, `password`, `subscription_id`, `status`, `created_at`) VALUES
(1, 'admin', '', 'admin@gmail.com', 1, '0e7517141fb53f21ee439b355b5a1d0a', '', 1, '2022-07-26 12:03:13'),
(2, 'Ayushi', 'Goyal', 'ayugoyal256@gmail.com', 2, '827ccb0eea8a706c4c34a16891f84e7b', 'sub_1LPmTkSClFQlcpYneX4R9OQd', 1, '2022-07-26 12:03:13'),
(4, 'Sneha', 'Goyal', 'sneha@gmail.com', 2, '827ccb0eea8a706c4c34a16891f84e7b', 'sub_1LPnD0SClFQlcpYncLpYfcOg', 1, '2022-07-26 12:50:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `payment_method` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `stripe_subscription_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stripe_customer_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stripe_plan_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plan_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plan_amount` float(10,2) NOT NULL,
  `plan_amount_currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `plan_period_start` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plan_period_end` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_subscriptions`
--

INSERT INTO `user_subscriptions` (`id`, `user_id`, `payment_method`, `stripe_subscription_id`, `stripe_customer_id`, `stripe_plan_id`, `plan_name`, `plan_amount`, `plan_amount_currency`, `plan_period_start`, `plan_period_end`, `payer_email`, `created`, `status`) VALUES
(1, 2, 'card', 'sub_1LPmTkSClFQlcpYneX4R9OQd', 'cus_M82YQ6mQwlHrcq', 'price_1LPlnTSClFQlcpYnuoP92Y7P', 'Basic Plan', 5.00, 'usd', '2022-07-26 14:03:12', '2022-08-26 14:03:12', 'ayugoyal256@gmail.com', '2022-07-26 12:03:13', 'incomplete'),
(2, 4, 'card', 'sub_1LPnD0SClFQlcpYncLpYfcOg', 'cus_M83JbW8mVj8E7B', 'price_1LPlrySClFQlcpYnHFdhsaRA', 'Professional Plan', 10.00, 'usd', '2022-07-26 14:49:58', '2022-08-26 14:49:58', 'sneha@gmail.com', '2022-07-26 12:50:00', 'incomplete');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
