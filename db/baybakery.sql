-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 07:17 AM
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
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
(1, 'brown butter chocolate chip cookies', 'https://i.imghippo.com/files/5alsk1717300358.webp', '1300', '1300', 'Cookies', '0'),
(2, 'Mix Cookies', 'https://i.imghippo.com/files/WZwEu1717300517.jpg', '2600', '2080', 'Cookies', '20'),
(3, 'Soft Frosted Sugar Cookies', 'https://i.imghippo.com/files/useZS1717300610.jpg', '1998', '1899', 'Cookies', '4.5'),
(4, 'WHOLEWHEAT CHOCOLATE COOKIES', 'https://i.imghippo.com/files/ad5wC1717300785.jpg', '1599', '1599', 'Cookies', '0'),
(5, 'Croissants', 'https://i.imghippo.com/files/m6iKh1717301009.jpg', '899', '800', 'Bread', '11'),
(6, 'Classic White Sandwich Bread', 'https://i.imghippo.com/files/1d0p81717301273.webp', '240', '200', 'Bread', '16'),
(7, 'No Knead Whole Wheat Bread', 'https://i.imghippo.com/files/1fUDq1717301367.jpg', '499', '499', 'Bread', '0'),
(8, 'Soft Bread Machine Garlic Breadsticks Recipe', 'https://i.imghippo.com/files/k42CF1717301446.jpg', '699', '499', 'Bread', '28'),
(9, 'Birthday Calendar Cake', 'https://i.imghippo.com/files/gIbqP1717302840.jpg', '3500', '3500', 'Cakes', '0'),
(10, 'Moist Chocolate Cake', 'https://i.imghippo.com/files/Weidu1717302905.jpg', '3900', '3900', 'Cakes', '0'),
(11, 'Black Forest Cake', 'https://i.imghippo.com/files/AAG9P1717302953.jpg', '1600', '1400', 'Cakes', '12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(8) NOT NULL,
  `email` text NOT NULL,
  `number` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `number`, `password`) VALUES
('WaCNF1fG', 'usmansaleem4446996@gmail.com', '03176535345', '$2y$10$BDgcpXnh4k46Nnc3KTbsr.Ddse6HHgcwkk8gsPaYJymzcMbkQERQO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
