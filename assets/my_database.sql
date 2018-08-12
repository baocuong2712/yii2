-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2018 at 08:00 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `phone_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `user_id`, `phone_number`) VALUES
(1, 3, '+39-12345678'),
(2, 4, '+47-98438923');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1533578603);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `price_per_day` decimal(20,2) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `reservation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `room_id`, `customer_id`, `price_per_day`, `date_from`, `date_to`, `reservation_date`) VALUES
(1, 2, 1, '90.00', '2015-04-01', '2015-05-06', '2018-08-01 08:34:58'),
(2, 2, 1, '48.00', '2019-08-27', '2019-08-31', '2018-08-01 08:34:58'),
(3, 1, 2, '105.00', '2015-09-24', '2015-10-06', '2015-06-02 17:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `has_conditioner` int(1) NOT NULL,
  `has_tv` int(1) NOT NULL,
  `has_phone` int(1) NOT NULL,
  `available_from` date NOT NULL,
  `price_per_day` decimal(20,2) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `floor`, `room_number`, `has_conditioner`, `has_tv`, `has_phone`, `available_from`, `price_per_day`, `description`) VALUES
(1, 1, 101, 1, 0, 1, '2015-05-20', '120.00', NULL),
(2, 2, 202, 0, 1, 1, '2015-05-30', '118.00', NULL),
(3, 3, 303, 0, 0, 0, '2020-12-12', NULL, ''),
(4, 1, 104, 1, 1, 1, '2012-12-12', NULL, ''),
(8, 1, 105, 1, 1, 1, '2012-12-12', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` int(2) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `access_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `first_name`, `last_name`, `role`, `auth_key`, `password_hash`, `access_token`) VALUES
(1, 'foo', 'foo@gmail.com', '', '', 1, '', '$2a$12$hL0rmIMjxhLqI.xr7jD1FugNWEgZNh62HuJj5.y34XBUfBWB4cppW', NULL),
(2, 'ken', 'ken@gmail.com', 'Ken', 'Bao', 2, '', '$2y$13$Xgums186sS0dhAZVcRFJEeWnBSH159Kt/xB6abjjQ1nNoQdqsC/dy', NULL),
(3, 'kung', 'kung@gmail.com', '', '', 3, 'odrmar1vFwgnYDq--VZL4WnnasRlaUfw', '$2y$13$Xgums186sS0dhAZVcRFJEeWnBSH159Kt/xB6abjjQ1nNoQdqsC/dy', NULL),
(4, 'alisa', 'alisa@gmail.com', 'Capri', 'Sargri', 3, '', '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`,`customer_id`),
  ADD KEY `room_id_2` (`room_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
