-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2023 at 11:32 AM
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
-- Database: `finance_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cumulative_expenses` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `user_id`, `category`, `amount`, `start_date`, `end_date`, `created_at`, `cumulative_expenses`) VALUES
(60, 7, 'Housing', 90000.00, '2023-10-27', '2023-10-27', '2023-10-27 10:50:32', 56402.00),
(61, 7, 'Entertainment', 500000.00, '2023-10-27', '2023-10-27', '2023-10-27 10:54:49', 400000.00);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Housing'),
(2, 'Utilities'),
(3, 'Transportation'),
(4, 'Healthcare'),
(5, 'Entertainment');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `user_id`, `date`, `category`, `amount`, `description`, `created_at`, `category_id`) VALUES
(116, 7, '2023-10-27', 'Housing', 2000.00, 'knjkn', '2023-10-27 10:51:52', NULL),
(117, 7, '2024-03-27', 'Housing', 2.00, 'uikj', '2023-10-27 10:53:53', NULL),
(118, 7, '2025-04-27', 'Entertainment', 400000.00, 'ygj', '2023-10-27 10:56:00', NULL),
(119, 7, '2026-04-27', 'Housing', 50000.00, 'jnkjn', '2023-10-27 10:57:37', NULL),
(120, 7, '2027-07-27', 'Housing', 300.00, 'jkcjscbf', '2023-10-27 13:26:37', NULL),
(121, 7, '2028-01-02', 'Housing', 4000.00, 'ggvgv', '2023-10-27 13:33:07', NULL),
(122, 7, '2028-06-27', 'Housing', 100.00, 'mnj', '2023-10-27 13:36:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `financial_goals`
--

CREATE TABLE `financial_goals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goal_name` varchar(255) NOT NULL,
  `goal_amount` decimal(10,2) NOT NULL,
  `goal_description` text DEFAULT NULL,
  `goal_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_goals`
--

INSERT INTO `financial_goals` (`id`, `user_id`, `goal_name`, `goal_amount`, `goal_description`, `goal_date`, `created_at`) VALUES
(9, 7, 'm', 5.00, 'nlkn', '2023-10-27', '2023-10-27 14:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `source` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `user_id`, `date`, `source`, `amount`, `description`, `created_at`) VALUES
(12, 7, '2023-10-25', 'Salary', 20000.00, 'I have earned 20k this month.', '2023-10-25 08:28:46'),
(13, 7, '2023-10-25', 'Investment', 50000.00, 'jnkj', '2023-10-25 12:20:44'),
(14, 7, '2023-10-25', 'Investment', 10000.00, 'uihiu', '2023-10-25 12:23:17'),
(15, 9, '2023-10-25', 'Salary', 200000.00, 'haiohc', '2023-10-25 12:31:15'),
(16, 9, '2023-09-25', 'Nedamco', 13500.00, 'sdnskcn', '2023-10-25 12:42:34'),
(17, 9, '2023-07-25', 'Renting', 40000.00, 'kmk', '2023-10-25 13:11:01'),
(18, 10, '2023-10-25', 'Nedamco', 13500.00, 'aconsao', '2023-10-25 13:29:16'),
(19, 10, '2023-10-27', 'Salary', 20000.00, 'fwf3fre', '2023-10-25 13:36:51'),
(20, 10, '2023-12-25', 'Nedamco', 30000.00, 'jnqwjdn', '2023-10-25 13:38:26'),
(21, 10, '2022-09-25', 'Nedamco', 69999.00, 'bh', '2023-10-25 13:41:28'),
(22, 11, '2023-10-25', 'Nedamco', 13500.00, 'hbugiu', '2023-10-25 13:46:46'),
(23, 11, '2023-12-25', 'Nedamco', 16000.00, 'bkjbj', '2023-10-25 13:51:06'),
(24, 12, '2023-10-25', 'Nedamco', 13500.00, 'ytffgghjg', '2023-10-25 13:57:23'),
(25, 12, '2023-12-25', 'Investment', 50000.00, 'sdfdscv', '2023-10-25 14:02:50'),
(26, 7, '2024-02-27', 'Nedamco', 1000.00, ' kh', '2023-10-27 10:42:49'),
(27, 7, '2023-10-27', 'tebedre yametahut nw', 9000.00, 'bjzbxjxz', '2023-10-27 10:50:01'),
(28, 7, '2024-03-27', 'Lottery', 1000000.00, 'nasnc', '2023-10-27 10:53:12'),
(29, 7, '2026-04-27', 'Nedamco', 2000000.00, 'jbkjb', '2023-10-27 10:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `read_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `read_status`, `created_at`) VALUES
(25, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-25 08:26:19'),
(26, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-25 08:30:11'),
(27, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-25 11:32:34'),
(28, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-25 11:33:39'),
(29, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-25 12:23:55'),
(30, 10, 'You have reached 80% of your budget for the category: Transportation.', 0, '2023-10-25 13:32:35'),
(31, 10, 'You have reached 100% of your budget for the category: Transportation.', 0, '2023-10-25 13:34:31'),
(32, 10, 'You have reached 100% of your budget for the category: Transportation.', 0, '2023-10-25 13:39:52'),
(33, 10, 'You have reached 100% of your budget for the category: Transportation.', 0, '2023-10-25 13:42:15'),
(34, 11, 'You have reached 100% of your budget for the category: Transportation.', 0, '2023-10-25 13:49:32'),
(35, 11, 'You have reached 100% of your budget for the category: Transportation.', 0, '2023-10-25 13:52:09'),
(36, 12, 'You have reached 80% of your budget for the category: Entertainment.', 0, '2023-10-25 13:59:56'),
(37, 12, 'You have reached 100% of your budget for the category: Entertainment.', 0, '2023-10-25 14:01:06'),
(38, 12, 'You have reached 100% of your budget for the category: Entertainment.', 0, '2023-10-25 14:03:22'),
(39, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 09:29:44'),
(40, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 09:35:01'),
(41, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 09:44:58'),
(42, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 09:45:15'),
(43, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 09:45:53'),
(44, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:13:21'),
(45, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:14:31'),
(46, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:17:00'),
(47, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:20:14'),
(48, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:23:52'),
(49, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:25:03'),
(50, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:26:31'),
(51, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:31:29'),
(52, 7, 'You have reached 100% of your budget for the category: Housing.', 0, '2023-10-27 10:43:25'),
(53, 7, 'You have reached 80% of your budget for the category: Entertainment.', 0, '2023-10-27 10:56:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `address`, `date_of_birth`, `gender`, `profile_picture`) VALUES
(1, 'test', 'test', 'test@gmail.com', '$2y$10$UQiyIJkFRDlWzZq.vNmrlejMIUvz21aFnr2T3IcGcYreF18KbJ7/2', '093456768', 'USA', '2023-10-25', 'Male', 'uploads/eminem-rap-god-bz-1536x864.jpg'),
(5, 'd', 'e', 'd@gmail.com', '$2y$10$rypW/J.azWssELIVWAVuRuGajOrHNyJnYiW/RHWd2i.G9C8wYJ.8.', '0936736373', 'frrfr', '2023-10-11', 'Male', NULL),
(7, 'Biruk', 'Metaferia', 'biruk@gmail.com', '$2y$10$EYYXJXMZhJUTqViN5v8bzu31/qT1bHn63k6FviRAvhzgJIddd7w4m', '0911111111', 'Saris, Addis Ababa', '2024-10-10', 'Male', NULL),
(9, 'bini', 'phase', 'bini@gmail.com', '$2y$10$1iIbGxrKklD00d.tzdYb4OEzaEnuHuokK3xB4dQ6n5wr1.g6FEIVW', '0923928264', 'Addis Ababa', '2000-11-25', 'Male', NULL),
(10, 'kindie', 'Hacker', 'kindie@gmail.com', '$2y$10$Q4ZsueXCZuP4T9FSdVCbSuQh0j8v2gFwQ.PrFReziO74KYEk2znpO', '0900000000', 'Addis Ababa', '2023-10-25', 'Female', NULL),
(11, 'kuku', 'melekote', 'kuku@gmail.com', '$2y$10$JJSsOtWQlYcb/ZnXjeOlEeci.62VgRWFyhjt3Q4bJLVTDDYB6kd/u', '0989789676', 'Addis Ababa', '2000-01-25', 'Female', NULL),
(12, 'bak', 'kab', 'bak@gmail.com', '$2y$10$PLP8JeBZHWCDSEXkOi8fMOmDJvcek5VcI2ayguYJrwAqnVDRTnaT6', '093435433', 'Addis Ababa', '2023-10-25', 'Other', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `financial_goals`
--
ALTER TABLE `financial_goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `financial_goals`
--
ALTER TABLE `financial_goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `financial_goals`
--
ALTER TABLE `financial_goals`
  ADD CONSTRAINT `financial_goals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
