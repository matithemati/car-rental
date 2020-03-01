-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2020 at 05:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `type` varchar(150) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `photo_url` varchar(245) COLLATE utf8_bin NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `type`, `price`, `photo_url`, `available`) VALUES
(1, 'Audi', 'Limuzyna', 100, 'audi.jpg', 0),
(2, 'Mercedes', 'Hot hatch', 130, 'mercedes.jpg', 0),
(3, 'Skoda', 'Kombi', 30, 'skoda.png', 0),
(4, 'Fiat 500', 'Miejskie', 60, 'fiat.jpg', 0),
(5, 'Nissan', 'Sportowe', 150, 'nissan.jpg', 0),
(6, 'Volvo', 'SUV', 80, 'volvo.jpg', 1),
(7, 'Renault', 'Sedan', 70, 'renault.jpg', 1),
(8, 'Ford Mustang', 'Sportowe', 150, 'mustang.jpg', 0),
(9, 'BMW', 'Sportowe', 160, 'bmw.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `surname` varchar(100) COLLATE utf8_bin NOT NULL,
  `phone_number` varchar(9) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `surname`, `phone_number`) VALUES
(1, 'Jan', 'Kowalski', '500500500'),
(2, 'Adam', 'Nowak', '300400500'),
(3, 'Mati', 'Test', '123456789'),
(4, 'Test', 'Test', '888888888'),
(5, 'Tester', 'Test', '111111111'),
(6, 'Adam', 'TestP', '123456789'),
(7, 'Adam', 'TestP', '123456789'),
(8, 'Test', 'xd', '123123123'),
(9, 'Lols', 'Lollll', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `status` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `car_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `status`, `car_id`) VALUES
(3, NULL, NULL, 1),
(4, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `from_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `to_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `client_id`, `car_id`, `from_date`, `to_date`, `cost`) VALUES
(1, 1, 8, '2020-02-29 12:52:47', '2020-03-10 12:00:00', 520),
(2, 3, 3, '2020-03-04 11:22:00', '2020-03-05 13:22:00', 780),
(3, 4, 5, '2020-03-03 00:02:00', '2020-03-16 01:02:00', 46950),
(4, 5, 2, '2020-03-04 00:01:00', '2020-03-05 00:01:00', 3120),
(5, 7, 3, '2020-03-04 00:01:00', '2020-03-05 01:01:00', 750),
(6, 8, 1, '2020-03-01 00:01:00', '2020-03-02 01:01:00', 2500),
(7, 9, 4, '2020-03-06 01:02:00', '2020-03-10 02:02:00', 5820);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'admin', '81fdc5844dd0910c5da5a79a8243dca416db29707fbee515f33d0ea2a96266b3437b1c2831636bccb89deaa9a811287a78abb0eda766483f4d7796282f1b5519');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_cars` ON SCHEDULE EVERY 1 HOUR STARTS '2020-03-01 16:54:06' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE cars SET available = 1 WHERE id IN (SELECT car_id FROM reservations WHERE to_date <= NOW())$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
