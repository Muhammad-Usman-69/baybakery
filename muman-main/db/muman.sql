-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 10:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muman`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `muman_id` int(11) NOT NULL,
  `msin` int(11) NOT NULL,
  `cart_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Console'),
(2, 'Flash Drive'),
(3, 'Chair'),
(4, 'Headphone'),
(5, 'Mouse'),
(6, 'Keyboard'),
(7, 'Screen');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `inquiry` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `inquiry`, `detail`, `time`) VALUES
(2, 'John Doe', 'usmansaleem4446996@gmail.com', 'i can\'t login into my account', 'i have been trying for the past three days to log in to my account but i can\'t', '2023-12-12 14:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_msin` int(11) NOT NULL,
  `product_name` text NOT NULL,
  `product_old_price` varchar(10) NOT NULL,
  `product_new_price` varchar(10) NOT NULL,
  `product_category` varchar(20) NOT NULL,
  `product_color` varchar(20) NOT NULL,
  `product_dimensions` varchar(30) NOT NULL,
  `product_weight` varchar(30) NOT NULL,
  `product_brand` varchar(20) NOT NULL,
  `product_image` int(11) NOT NULL,
  `product_delivery_charges` int(11) NOT NULL,
  `product_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_msin`, `product_name`, `product_old_price`, `product_new_price`, `product_category`, `product_color`, `product_dimensions`, `product_weight`, `product_brand`, `product_image`, `product_delivery_charges`, `product_rating`) VALUES
(1, 'Cowin Blue Wholesale Aviation Active Noise Cancelling Headphones, Wired Gaming Earphones, Headsets, Bluetooth Headphones, Wireless', '79.99', '59.99', 'Headphone', 'Blue', '22.5 x 20.2 x 7.3', '0.750', 'None', 4, 10, 1),
(2, 'Modern, soft, and comfortable office E-sports club chair designed for ergonomic gaming on computers', '219.99', '199.99', 'Chair', 'Blue', '50 x 130 x 30', '113.4', 'None', 4, 80, 4),
(3, 'New and stylish Auricularess Bluetooth earbuds, custom waterproof design, perfect for immersive gaming experiences.', '29.99', '24.99', 'Headphone', 'Black', '9 x 9 x 4 ', '0.120', 'None', 4, 10, 3),
(4, 'High-quality 24 - 27 computer monitor with a 2K or 4K LCD screen, offering crisp visuals and optimal gaming performance', '99.99', '89.99', 'Screen', 'Black', '115 x 70 x 12', '11.2', 'None', 4, 30, 2),
(5, 'EASE EM200 Wireless Mouse', '39.99', '24.99', 'Mouse', 'Black', '22.5 x 20.2 x 7.3', '0.067', 'None', 4, 10, 5),
(6, 'Logitech G USB G G203 Wired Gaming Mouse 8000 DPI Rainbow Optical Effect LIGHTSYNC RGB 6 Programmable Buttons On Board Memory Screen Mapping PCMac', '89.99', '84.99', 'Mouse', 'RGB', '11.6 x 6.25 x 38.2', '0.085', 'None', 4, 10, 6),
(7, 'DXRacer Prince Series P132 Gaming Chair Red Black GC P132 RN F2 01', '199.9', '204.99', 'Chair', 'Red', '50 x 130 x 30', '113.4', 'None', 4, 80, 7),
(8, 'LSony PlayStation 4 Slim (500GB) Jet Black', '599.99', '549.99', 'Console', 'Black', '15.1 x 15.1 x 30.1', '2.120', 'None', 4, 10, 8),
(9, 'Microsoft Xbox One X 1TB Console Black CYV 00001', '629.99', '599.99', 'Console', 'Black', '15.1 x 15.1 x 30.1', '2.120', 'None', 4, 10, 9),
(10, 'MFi Certified 128GB Photo Stick for iPhone Flash Drive,USB Memory Stick Thumb Drives High Speed USB Stick External Storage Compatible for iPhoneiPadAndroidPC', '19.99', '14.99', 'Flash Drive', 'White', '7.3 x 1.6 x 0.9', '0.200', 'None', 3, 10, 10),
(11, 'MSanDisk 64GB Ultra Flair USB 3.0 Flash Drive', '29.99', '24.99', 'Flash Drive', 'Grey', '7.3 x 1.6 x 0.9', '0.200', 'None', 2, 10, 11),
(12, 'Tronsmart Battle Ultra Low Latency Gaming Earbuds Black', '39.99', '34.99', 'Headphone', 'Grey', '9 x 9 x 4', '0.140', 'None', 4, 10, 12),
(13, 'RGB Gaming Keyboard 10 Zone RGB Illumination IP32 Water Resistant Premium Magnetic Wrist Rest', '89.99', '84.99', 'Keyboard', 'RGB', '45.8 x 14.2 x 2.5', '1.4', 'None', 4, 10, 13),
(14, 'RPM Euro Games Gaming Keyboard With 87 Keys & RGB Backlit With Suspension Keys Wired USB Gaming Keyboard (Black)', '99.99', '94.99', 'Keyboard', 'RGB', '45.8 x 14.2 x 2.5', '1.4', 'None', 4, 10, 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `muman_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_pass` text NOT NULL,
  `sign_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`muman_id`, `user_name`, `user_email`, `user_pass`, `sign_time`) VALUES
(1, 'admin', 'usmansaleem4446996@gmail.com', '$2y$10$ZhQay6cjFF8BGAPNiY6.H.3mXf6PPm2ZkStbLqYTDCroAAC8kn0sG', '2023-12-09 15:31:25'),
(4, 'John Doe', 'fadeye7291@jalunaki.com', '$2y$10$4nCGNLxWnGQsfrZ7wxfBnu.GPtUowaFx4jp1KlflCSTqMhmHDh.qm', '2023-12-09 15:16:24');

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
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_msin`);
ALTER TABLE `products` ADD FULLTEXT KEY `product_name` (`product_name`,`product_brand`,`product_color`);
ALTER TABLE `products` ADD FULLTEXT KEY `product_category` (`product_category`,`product_brand`,`product_color`);
ALTER TABLE `products` ADD FULLTEXT KEY `product_name_2` (`product_name`,`product_category`,`product_color`,`product_brand`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`muman_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `muman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
