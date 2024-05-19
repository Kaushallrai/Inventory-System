-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8111
-- Generation Time: May 17, 2024 at 09:40 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(26, 'Athletic Shoe'),
(22, 'Boot'),
(25, 'Loafer'),
(24, 'Sandal'),
(27, 'Sliders'),
(23, 'Sneakers');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(3, 'Boy\'s ASICS- Athletic Shoes.jpg', 'image/jpeg'),
(4, 'Women\'s Merrell Al Out Fuse -- Athletics Shoes.jpeg', 'image/jpeg'),
(5, 'Men Carolina Hiking Boots.jpeg', 'image/jpeg'),
(6, 'Nike Manoa Leather Men\'s Boots.jpeg', 'image/jpeg'),
(7, 'Mens Classic Tassel PU Leather Loafers.jpg', 'image/jpeg'),
(8, 'Mens Smart Patent Leather Lined Loafers Slip.jpeg', 'image/jpeg'),
(9, 'Flat Sandals - Women.jpeg', 'image/jpeg'),
(10, 'Summer Women Sandals.jpeg', 'image/jpeg'),
(11, 'Nike Women\'s Kawa Slide.jpeg', 'image/jpeg'),
(12, 'Aerothotic Quin Velcro Strap Women Slide.jpeg', 'image/jpeg'),
(13, 'Crossbar Sneakers.jpeg', 'image/jpeg'),
(14, 'Cannabis Yeezy Sneakers Shoes.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(30, 'Boys ASICS', '40', '2000.00', '3000.00', 26, 3, '2023-05-08 11:38:38'),
(31, 'Womens Merrell Al Out Fuse', '50', '3000.00', '3500.00', 26, 4, '2023-05-08 11:44:12'),
(32, 'Carolina Hiking Boots', '50', '1500.00', '2200.00', 22, 5, '2023-05-08 12:09:37'),
(33, 'Nike Manoa Leather Men Boots', '50', '1500.00', '1999.00', 22, 6, '2023-05-08 12:10:07'),
(34, 'Men Classic Tassel PU Leather Loafers', '20', '1000.00', '1599.00', 25, 7, '2023-05-08 12:10:46'),
(35, 'Mens Smart Patent Leather Lined Loafers ', '10', '1700.00', '2500.00', 25, 8, '2023-05-08 12:11:24'),
(36, 'Flat Sandals', '100', '500.00', '999.00', 24, 9, '2023-05-08 12:11:57'),
(37, 'Summer Womens Sandal', '50', '700.00', '1499.00', 24, 10, '2023-05-08 12:12:22'),
(38, 'Nike Women Kawa Slide', '20', '999.00', '1600.00', 27, 11, '2023-05-08 12:12:58'),
(39, 'Aerothotic Quin Velcro Strap Women Slide', '0', '1500.00', '2600.00', 27, 12, '2023-05-08 12:13:35'),
(40, 'Crossbar Sneaker', '60', '2000.00', '3500.00', 23, 13, '2023-05-08 12:13:59'),
(41, 'Cannabis Yezzy Sneakers Shoes', '150', '1599.00', '2099.00', 23, 14, '2023-05-08 12:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `qty`, `price`, `date`) VALUES
(38, 30, 30, '90000.00', '2023-05-08'),
(39, 41, 10, '20990.00', '2023-05-08'),
(42, 32, 50, '110000.00', '2023-05-10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(7, 'Sudeep Prasain', 'Sudeep', '35c501f2687d09155b75237c672a7ca88cec4167', 1, 'f55myjp7.jpg', 1, '2023-05-10 21:36:27'),
(11, 'Purnima Thapa', 'purnima', 'cef881bb0dbe9b2f18f090d5918336fb1533dff4', 2, 'ui3k27g811.png', 1, '2023-05-09 07:51:59'),
(12, 'Mandhoj Thing', 'mandhoj', 'd2106700f1e74652e849cfa234892478dd755a47', 3, 'wpmyid312.png', 1, '2023-05-09 07:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(3, 'Sales Manager', 3, 1),
(4, 'Product Catalog Manager', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
