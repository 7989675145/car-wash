-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 07:05 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_wash`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `wash_id` varchar(20) NOT NULL,
  `number` varchar(20) NOT NULL,
  `id` varchar(20) NOT NULL,
  `dated` varchar(20) NOT NULL,
  `slot` varchar(30) NOT NULL DEFAULT '0',
  `price` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0' COMMENT '0 for pending,\r\n1 for Approved\r\n2 for Rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `wash_id`, `number`, `id`, `dated`, `slot`, `price`, `status`) VALUES
(33, '11', 'AP83JD8838', '15', '20-02-2021', '7', '1500', '1'),
(34, '11', 'AP63FS4412', '15', '20-02-2021', '3', '1500', '1'),
(53, '2', 'AP86ET1343', '19', '09-02-2021', '1', '900', '1'),
(55, '6', 'TN07BX5507', '22', '10-02-2021', '5', '344', '1'),
(105, '11', 'ASFASDFDFD', '15', '20-02-2021', '3', '1500', '1'),
(108, '6', 'AP34DF3456', '59', '20-02-2021', '1', '344', '1'),
(110, '11', 'AP43DF2453', '60', '20-02-2021', '1', '1500', '0'),
(111, '11', 'AP63HF9832', '61', '20-02-2021', '3', '1500', '0'),
(112, '22', 'SP87FG3456', '15', '18-02-2021', '1', '551', '2'),
(113, '22', 'AP89FG7456', '15', '20-02-2021', '8', '551', '0'),
(114, '2', 'AO56TY5678', '15', '26-02-2021', '2', '900', '0'),
(115, '11', 'AP76HF8769', '19', '27-02-2021', '7', '1500', '0');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_type` varchar(20) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `phone`, `password`, `date`, `user_type`) VALUES
(13, '9999999999', '202cb962ac59075b964b07152d234b70', '2021-02-04 11:58:10', '1'),
(15, '7878787878', '202cb962ac59075b964b07152d234b70', '2021-02-04 12:07:36', '2'),
(19, '8888888888', '202cb962ac59075b964b07152d234b70', '2021-02-09 05:39:53', '2'),
(22, '9704027121', '63c4fd91cf4121bc58456784e41de4d1', '2021-02-10 10:49:59', '2'),
(59, '1111111111', '202cb962ac59075b964b07152d234b70', '2021-02-17 11:45:09', '2'),
(60, '2222222222', '202cb962ac59075b964b07152d234b70', '2021-02-17 11:55:32', '2'),
(61, '3333333333', '202cb962ac59075b964b07152d234b70', '2021-02-17 11:57:26', '2'),
(62, '1212121212', '202cb962ac59075b964b07152d234b70', '2021-02-24 01:08:58', '2');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` varchar(20) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `name`) VALUES
('15', 'raj'),
('19', 'kalyan'),
('22', 'chaitany'),
('59', 'JHD'),
('60', 'WERT'),
('61', 'DSGSG'),
('62', 'aad');

-- --------------------------------------------------------

--
-- Table structure for table `wash_prices`
--

CREATE TABLE `wash_prices` (
  `wash_id` int(11) NOT NULL,
  `car_type` varchar(20) NOT NULL COMMENT '1 for Hatchback,\r\n2 for Sedan, \r\n3 for SUV ',
  `wash_type` varchar(20) NOT NULL COMMENT '1 for interior,\r\n2 for body,\r\n3 for full',
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wash_prices`
--

INSERT INTO `wash_prices` (`wash_id`, `car_type`, `wash_type`, `price`) VALUES
(2, '2', '1', '900'),
(3, '2', '3', '2500'),
(6, '1', '1', '346'),
(11, '2', '2', '1500'),
(13, '3', '3', '3454'),
(21, '1', '3', '1200'),
(22, '1', '2', '550');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD UNIQUE KEY `book_id` (`book_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `wash_prices`
--
ALTER TABLE `wash_prices`
  ADD PRIMARY KEY (`wash_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `wash_prices`
--
ALTER TABLE `wash_prices`
  MODIFY `wash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
