-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 07:11 PM
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
-- Database: `sweet_treats`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$QWhOzMBC6I/gHDnHKwcb7.EwHGBXiBmiDB6CIQ63KGd9n6obxLtVq');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `menu_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`, `image`) VALUES
(1, 'Classic Black Coffee', 'Freshly brewed to perfection, our black coffee features a bold, aromatic flavor and smooth finish—ideal for a pure coffee experience. Perfectly balanced and served steaming hot, it’s your essential morning boost or anytime pick-me-up.', 3.25, '2025-04-10 16:38:50', 'uploads/coffee-hero-section.png'),
(3, 'Strawberry Delight', 'Indulge in layers of fresh, juicy strawberries nestled within a silky-smooth cream, topped with a delicate sprinkle of powdered sugar and a hint of mint. A delightful dessert that perfectly balances sweetness and freshness—pure berry bliss in every bite!', 5.99, '2025-04-10 16:41:43', 'uploads/desserts.png'),
(4, 'Iced Coffee Delight', 'Refresh yourself with our chilled and creamy iced coffee, crafted from freshly brewed espresso, blended with milk, and served over ice. Smooth, cool, and perfectly sweetened—your ultimate drink for a refreshing boost!', 2000.00, '2025-04-10 16:41:56', 'uploads/cold-beverages.png'),
(5, 'Strawberry Delight', 'Indulge in layers of fresh, juicy strawberries nestled within a silky-smooth cream, topped with a delicate sprinkle of powdered sugar and a hint of mint. A delightful dessert that perfectly balances sweetness and freshness—pure berry bliss in every bite!', 111.00, '2025-04-10 16:54:10', 'uploads/desserts.png'),
(6, '', 'Juicy grilled chicken breast layered with crisp lettuce, ripe tomatoes, and creamy mayo, nestled between slices of freshly toasted bread.\r\n\r\nVeggie Delight Sandwich (V)\r\nA garden-fresh medley of crisp cucumbers, tomatoes, crunchy bell peppers, lettuce, and creamy avocado spread, served on whole-grain bread.\r\n\r\nHam &amp; Cheese Melt\r\nSavoury sliced ham paired with melted cheddar cheese, gently grilled between buttery toasted bread—classic comfort in every bite!\r\n\r\nTuna Salad Sandwich\r\nFreshly prepared tuna salad blended with celery and mayonnaise, topped with crispy lettuce and sliced tomatoes, served on your choice of bread.\r\n\r\nBLT Classic\r\nCrispy bacon strips, fresh lettuce, ripe tomatoes, and creamy mayo, stacked generously on lightly toasted bread—simply delicious!\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 25.99, '2025-04-10 16:58:58', 'uploads/special-combo.png');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `monday_hours` varchar(50) DEFAULT NULL,
  `tuesday_hours` varchar(50) DEFAULT NULL,
  `wednesday_hours` varchar(50) DEFAULT NULL,
  `thursday_hours` varchar(50) DEFAULT NULL,
  `friday_hours` varchar(50) DEFAULT NULL,
  `saturday_hours` varchar(50) DEFAULT NULL,
  `sunday_hours` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `map_link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `site_name`, `email`, `phone`, `address`, `monday_hours`, `tuesday_hours`, `wednesday_hours`, `thursday_hours`, `friday_hours`, `saturday_hours`, `sunday_hours`, `created_at`, `map_link`) VALUES
(1, 'Sweet Treats Bakery', 'arcadiiflorean789@gmail.com', '07454185152', '4 Burton avenue', '09.00-17.00', '09.00-17.00', '09.00-17.00', '09.00-17.00', '09.00-17.00', '09.00-14.00', 'Holidays ', '2025-04-10 15:55:02', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'admin', '$2y$10$5TfHX3YzZlhzpIM3dApBduH3iYVbcXGOFyZKrp9Tj3oR.qk7EvZeW', 'admin@example.com', '2025-04-10 16:07:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
