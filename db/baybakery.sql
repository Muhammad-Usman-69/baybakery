-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2024 at 01:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baybakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` varchar(5) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `product_id` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `product_id`) VALUES
('cyTD8', 'muhammadusman001', 'IUKV');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` int(8) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`) VALUES
(1, 'Bread', 1),
(2, 'Cakes', 1),
(3, 'Cookies', 1);

-- --------------------------------------------------------

--
-- Table structure for table `num`
--

CREATE TABLE `num` (
  `num` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `num`
--

INSERT INTO `num` (`num`) VALUES
(19);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `arrange_order` int(11) NOT NULL,
  `id` varchar(12) NOT NULL,
  `details` text NOT NULL,
  `time` datetime NOT NULL,
  `userid` varchar(50) NOT NULL,
  `method` text NOT NULL,
  `price` text NOT NULL,
  `delivery_price` text NOT NULL,
  `delivery_location` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`arrange_order`, `id`, `details`, `time`, `userid`, `method`, `price`, `delivery_price`, `delivery_location`, `status`) VALUES
(131, 'BB-19', '4x (tGO7) Black Forest Cake (Rs. 1400) \n\n', '2024-06-05 02:44:43', 'muhammadusman443', 'Online', '6000', '400', 'Black Forest Cake', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(4) NOT NULL,
  `title` text NOT NULL,
  `img` text NOT NULL,
  `old_price` text NOT NULL,
  `new_price` text NOT NULL,
  `category` text NOT NULL,
  `discount` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `feature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `img`, `old_price`, `new_price`, `category`, `discount`, `status`, `feature`) VALUES
('0t2u', 'Croissants', 'https://i.imghippo.com/files/m6iKh1717301009.jpg', '1000', '800', 'Bread', '20', 1, 1),
('AUha', 'WHOLEWHEAT CHOCOLATE COOKIES', 'https://i.imghippo.com/files/ad5wC1717300785.jpg', '1599', '1599', 'Cookies', '0', 1, 1),
('IUKV', 'WHOLEWHEAT CHOCOLATE COOKIES', '../images/products/6660462ecbd168.87984576.jpg', '12', '12', 'Cakes', '0', 1, 0),
('lZkT', 'Mix Cookies', 'https://i.imghippo.com/files/WZwEu1717300517.jpg', '2600', '2080', 'Cookies', '20', 1, 0),
('m6F9', 'brown butter chocolate chip cookies', 'https://i.imghippo.com/files/5alsk1717300358.webp', '1300', '1300', 'Cookies', '0', 1, 1),
('M9dz', 'Soft Frosted Sugar Cookies', 'https://i.imghippo.com/files/useZS1717300610.jpg', '1998', '1899', 'Cookies', '4.5', 1, 0),
('otSp', 'Soft Bread Machine Garlic Breadsticks Recipe', 'https://i.imghippo.com/files/k42CF1717301446.jpg', '699', '499', 'Bread', '28', 1, 1),
('RYZb', 'Moist Chocolate Cake', 'https://i.imghippo.com/files/Weidu1717302905.jpg', '3900', '3900', 'Cakes', '0', 1, 0),
('sBmF', 'Classic White Sandwich Bread', 'https://i.imghippo.com/files/1d0p81717301273.webp', '240', '200', 'Bread', '16', 1, 1),
('tGO7', 'Black Forest Cake', 'https://i.imghippo.com/files/AAG9P1717302953.jpg', '1600', '1400', 'Cakes', '12', 1, 0),
('xUMn', 'No Knead Whole Wheat Bread', 'https://i.imghippo.com/files/1fUDq1717301367.jpg', '499', '499', 'Bread', '0', 1, 1),
('zNQe', 'Birthday Calendar Cake', 'https://i.imghippo.com/files/gIbqP1717302840.jpg', '3500', '3500', 'Cakes', '0', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `number` text NOT NULL,
  `password` text NOT NULL,
  `admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `admin`) VALUES
('muhammadusman', 'Muhammad Usman', 'usmansaleem4446996@gmail.com', '+92 3176535345', '$2y$10$SAi1d5FCXzLoco9BGPh.VePpK8PPdo3iSEtKy/DXp.uQCpdsxW1Rq', 1),
('muhammadusman001', 'Muhammad Usman', 'mrfear4646@gmail.com', '+92 3269165351', '$2y$10$Bs.b8eyW5z4lDi8ezeIigOEA/4PfpSWrSdXWa0sgxQXtFmian0pZi', 0),
('muhammadusman443', 'Muhammad Usman', 'lubivuty@molecule.ink', '+92 1312312312', '$2y$10$C.4jEnCuWOSTyB4j8rjLwOvF5um3kRsG1FxWlOmEZeGhBJMdsF8RC', 0);

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `id` varchar(50) NOT NULL,
  `code` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `verify`
--

INSERT INTO `verify` (`id`, `code`) VALUES
('muhammadusman', ''),
('muhammadusman001', ''),
('muhammadusman443', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `num`
--
ALTER TABLE `num`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `increament` (`arrange_order`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `arrange_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
