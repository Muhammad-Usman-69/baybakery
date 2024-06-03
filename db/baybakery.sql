-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 02:36 PM
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
('lXGgs', 'Muhammad Usman 001', 'M9dz'),
('U8NNj', 'Muhammad Usman 001', 'm6F9');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Bread'),
(2, 'Cakes'),
(3, 'Cookies');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` varchar(12) NOT NULL,
  `details` text NOT NULL,
  `time` time NOT NULL,
  `userid` varchar(50) NOT NULL,
  `method` text NOT NULL,
  `price` text NOT NULL,
  `delivery_price` text NOT NULL,
  `delivery_location` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `details`, `time`, `userid`, `method`, `price`, `delivery_price`, `delivery_location`, `status`) VALUES
('3RoS8QbRiUxO', '1x (tGO7) Black Forest Cake (Rs. 1400) \n\n1x (RYZb) Moist Chocolate Cake (Rs. 3900) \n\n1x (sBmF) Classic White Sandwich Bread (Rs. 200) \n\n', '04:47:18', 'FxqaozED', 'Online', '6700', '1200', 'Apptechz', 1),
('40RuYbOQUAdX', '1x (M9dz) Soft Frosted Sugar Cookies (Rs. 1899) \n\n', '04:35:04', 'STXGRaNZ', 'Online', '2299', '400', 'appstech', 0),
('HALW5oU5vMjN', '1x (m6F9) brown butter chocolate chip cookies (Rs. 1300) \n\n', '04:36:17', 'MhT0CWZb', 'CashOnDelivery', '1700', '400', 'appstech', 0),
('w1NsO5f0BM9z', '1x (m6F9) brown butter chocolate chip cookies (Rs. 1300) \n\n1x (sBmF) Classic White Sandwich Bread (Rs. 200) \n\n1x (otSp) Soft Bread Machine Garlic Breadsticks Recipe (Rs. 499) \n\n', '04:34:15', 'MhT0CWZb', 'Online', '3199', '1200', 'Apptech, Behria Town Multan Near Mall of Multan, Multan', 0),
('yfutrROmDaFL', '1x (sBmF) Classic White Sandwich Bread (Rs. 200) \n\n', '01:05:35', 'STXGRaNZ', 'Online', '600', '400', 'apptech', 1);

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
  `discount` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `img`, `old_price`, `new_price`, `category`, `discount`) VALUES
('0t2u', 'Croissants', 'https://i.imghippo.com/files/m6iKh1717301009.jpg', '899', '800', 'Bread', '11'),
('AUha', 'WHOLEWHEAT CHOCOLATE COOKIES', 'https://i.imghippo.com/files/ad5wC1717300785.jpg', '1599', '1599', 'Cookies', '0'),
('lZkT', 'Mix Cookies', 'https://i.imghippo.com/files/WZwEu1717300517.jpg', '2600', '2080', 'Cookies', '20'),
('m6F9', 'brown butter chocolate chip cookies', 'https://i.imghippo.com/files/5alsk1717300358.webp', '1300', '1300', 'Cookies', '0'),
('M9dz', 'Soft Frosted Sugar Cookies', 'https://i.imghippo.com/files/useZS1717300610.jpg', '1998', '1899', 'Cookies', '4.5'),
('otSp', 'Soft Bread Machine Garlic Breadsticks Recipe', 'https://i.imghippo.com/files/k42CF1717301446.jpg', '699', '499', 'Bread', '28'),
('RYZb', 'Moist Chocolate Cake', 'https://i.imghippo.com/files/Weidu1717302905.jpg', '3900', '3900', 'Cakes', '0'),
('sBmF', 'Classic White Sandwich Bread', 'https://i.imghippo.com/files/1d0p81717301273.webp', '240', '200', 'Bread', '16'),
('tGO7', 'Black Forest Cake', 'https://i.imghippo.com/files/AAG9P1717302953.jpg', '1600', '1400', 'Cakes', '12'),
('xUMn', 'No Knead Whole Wheat Bread', 'https://i.imghippo.com/files/1fUDq1717301367.jpg', '499', '499', 'Bread', '0'),
('zNQe', 'Birthday Calendar Cake', 'https://i.imghippo.com/files/gIbqP1717302840.jpg', '3500', '3500', 'Cakes', '0');

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
('Muhammad Usman', 'Muhammad Usman', 'usmansaleem4446996@gmail.com', '+92 3176535345', '$2y$10$SAi1d5FCXzLoco9BGPh.VePpK8PPdo3iSEtKy/DXp.uQCpdsxW1Rq', 1),
('Muhammad Usman 001', 'Muhammad Usman', 'mrfear4646@gmail.com', '+92 3269165351', '$2y$10$Bs.b8eyW5z4lDi8ezeIigOEA/4PfpSWrSdXWa0sgxQXtFmian0pZi', 0);

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
('Muhammad Usman', ''),
('Muhammad Usman 001', '');

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
