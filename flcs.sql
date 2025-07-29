-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2025 at 02:06 PM
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
-- Database: `flcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `selected_option` enum('A','B','C','D') NOT NULL,
  `is_correct` tinyint(1) DEFAULT 0,
  `subject` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(150) NOT NULL,
  `pro_image` varchar(255) DEFAULT NULL,
  `pro_price` decimal(10,2) NOT NULL,
  `pro_amount` int(11) DEFAULT 1,
  `stock` int(11) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `pro_id`, `pro_name`, `pro_image`, `pro_price`, `pro_amount`, `stock`, `user_id`, `created_at`) VALUES
(1, 2, 'Trousers', 'Trouser.png', 3000.00, 2, 0, 3, '2025-07-29 11:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `is_read` enum('unread','read') DEFAULT 'unread',
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `title`, `username`, `description`, `is_read`, `date_sent`) VALUES
(1, 'Error', 'Reginald2', 'Tables not working', 'read', '2025-07-29 11:42:44');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `gallery` varchar(255) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `gallery`, `title`, `created_at`) VALUES
(1, '7.jpg', '', '2025-07-29 11:40:40'),
(2, '3.jpeg', '', '2025-07-29 11:40:46'),
(3, '2.jpeg', '', '2025-07-29 11:40:53'),
(4, '5.jpg', '', '2025-07-29 11:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `paystack_payment`
--

CREATE TABLE `paystack_payment` (
  `id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `product` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `delivered` varchar(255) NOT NULL DEFAULT 'undelivered',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `pro_name` varchar(150) NOT NULL,
  `stock` int(11) DEFAULT 0,
  `pro_image` varchar(255) DEFAULT NULL,
  `pro_desc` text DEFAULT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sales_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `barcode`, `pro_name`, `stock`, `pro_image`, `pro_desc`, `purchase_price`, `sales_price`, `created_at`) VALUES
(1, '9088877345678', 'Hijab', 3, 'Hijab.png', 'The hijab is of high quality', 5000.00, 3000.00, '2025-07-29 10:52:44'),
(2, '9088877345623', 'Trousers', 5, 'Trouser.png', 'Trouser of good quality', 3000.00, 5000.00, '2025-07-29 10:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `class_level` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `question` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `correct_option` enum('A','B','C','D') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `userId` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `class` varchar(50) DEFAULT NULL,
  `school_fees` varchar(255) NOT NULL DEFAULT 'unpaid',
  `role_as` varchar(20) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `userId`, `username`, `phone_number`, `password`, `class`, `school_fees`, `role_as`, `created_at`) VALUES
(1, 'STUDENT495', 'Abdulsalam123', '07082648913', '$2y$10$Bq1fr9OwEoDILY3HOUE1I.24mWQFUFFE60CLpTZPWQ7RvWDJvOI2O', 'JSS1', 'unpaid', '1', '2025-07-29 10:39:33'),
(3, 'STUDENT802', 'Reginald2', '07082648913', '$2y$10$soKbSYpMRpIsgxT0fdOdUOhYYFRA7LCUNTqchKsXnZ9GK0yeqQy9e', 'JSS3', 'unpaid', '0', '2025-07-29 11:38:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paystack_payment`
--
ALTER TABLE `paystack_payment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barcode` (`barcode`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paystack_payment`
--
ALTER TABLE `paystack_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `paystack_payment`
--
ALTER TABLE `paystack_payment`
  ADD CONSTRAINT `paystack_payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
