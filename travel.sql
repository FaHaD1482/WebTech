-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 10:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `package_id`, `start_date`, `end_date`, `total_price`, `status`, `created_at`) VALUES
(8, 12, 5, '2025-01-22', '2025-01-24', 20000.00, 'confirmed', '2025-01-22 04:35:32'),
(9, 12, 5, '2025-01-22', '2025-01-28', 30000.00, 'confirmed', '2025-01-22 04:36:21'),
(10, 19, NULL, '2025-01-22', '2025-01-24', 150000.00, 'confirmed', '2025-01-22 05:34:00'),
(11, 19, 1, '2025-01-22', '2025-01-23', 5000.00, 'confirmed', '2025-01-22 08:21:13'),
(12, 19, 5, '2025-01-22', '2025-01-25', 30000.00, 'confirmed', '2025-01-22 10:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `package_id`, `comment`, `created_at`) VALUES
(1, 12, 1, 'This was the best trip I have ever been on! The team was amazing.', '2025-01-01 04:00:00'),
(2, 15, 2, 'I had a great time. Everything was perfectly planned!', '2025-01-02 08:30:00'),
(3, 16, 2, 'Absolutely loved it! The destinations were fantastic.', '2025-01-03 10:45:00'),
(4, 17, 5, 'Wonderful experience, but the food could have been better.', '2025-01-04 06:00:00'),
(17, 12, 2, 'Review AJAX Testing....', '2025-01-22 04:01:57'),
(19, 19, 1, 'Best Place ever!', '2025-01-22 08:21:30'),
(20, 19, 5, 'guohd', '2025-01-22 10:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `travel_packages`
--

CREATE TABLE `travel_packages` (
  `package_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `package_image` varchar(255) NOT NULL,
  `included_with` text DEFAULT NULL,
  `excluded_by` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `max_people` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `travel_packages`
--

INSERT INTO `travel_packages` (`package_id`, `name`, `description`, `price`, `duration_days`, `created_by`, `package_image`, `included_with`, `excluded_by`, `start_date`, `end_date`, `max_people`) VALUES
(1, 'Dhaka City Tour', 'Explore the vibrant capital city of Bangladesh with guided tours to historic sites and local attractions.', 5000.00, 1, 1, 'assets/Images/dhaka.jpg', 'Return air ticket|Accommodation in the mentioned hotels or similar|Breakfast|Room and hotel services as per the hotels policies|Airport to hotel return transfer|All tour and sightseeing as per the itinerary|All activities as per itinerary', 'Visa fees, Any insurance fees, Personal expenses, Beverages and meals, Lunch and dinner, Hotel early check-in & late check-out, Anything not mentioned in the including, Any city tax or tourism fee, Package price invalid during High, Peak, Super Peak Seasons, holidays, or occasions.Visa fees|Any insurance fees|Personal expenses|Beverages and meals|Lunch and dinner|Hotel early check-in & late check-out|Anything not mentioned in the including|Any city tax or tourism fee|Package price invalid during High, Peak, Super Peak Seasons, holidays, or occasions', '2025-02-01', '2025-02-02', 20),
(2, 'Cox’s Bazar Getaway', 'Enjoy the longest sea beach in the world with luxurious accommodations and activities.', 12000.00, 3, 1, 'assets/Images/coxs-bazar.jpg', 'Return air ticket|Accommodation in the mentioned hotels or similar|Breakfast|Room and hotel services as per the hotels policies|Airport to hotel return transfer|All tour and sightseeing as per the itinerary|All activities as per itinerary', 'Visa fees|Any insurance fees|Personal expenses|Beverages and meals|Lunch and dinner|Hotel early check-in & late check-out|Anything not mentioned in the including|Any city tax or tourism fee|Package price invalid during High, Peak, Super Peak Seasons, holidays, or occasions', '2025-01-25', '2025-01-28', 5),
(5, 'Rangamati Hill Escape', 'Experience the serene beauty of hill tracts with boating, hiking, and cultural exploration.', 10000.00, 2, 1, 'assets/Images/rangamati.jpg', 'Return air ticket|Accommodation in the mentioned hotels or similar|Breakfast|Room and hotel services as per the hotels policies|Airport to hotel return transfer|All tour and sightseeing as per the itinerary|All activities as per itinerary', 'Visa fees|Any insurance fees|Personal expenses|Beverages and meals|Lunch and dinner|Hotel early check-in & late check-out|Anything not mentioned in the including|Any city tax or tourism fee|Package price invalid during High, Peak, Super Peak Seasons, holidays, or occasions', '2025-01-22', '2025-01-24', 15),
(11, 'Australia', 'Meet the wild of Auatralia', 10000.00, 10, 1, 'assets/Images/3.jpg', '', '', '0000-00-00', '0000-00-00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `is_validated` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `address`, `profile_picture`, `role`, `is_validated`, `created_at`) VALUES
(1, 'Mahmud Reza Mahim', 'mahim@gmail.com', '$2y$10$VSMPRJ/9s.IiMF1GyI/W9ePaIgNFJqtYCNr9f5CoYwJYHQDZvCYXm', '123456678', 'Dhaka, Bangladesh', 'assets/Images/profiles/1737408092_Coverpic.jpg', 'admin', 1, '2025-01-20 21:21:32'),
(12, 'Emon', 'emon@gmail.com', '$2y$10$5IpR7teY0kb7/hd0TGo96.6dLNvJe46ityDQYOsklpCLtLTTBZIiO', '01712445348', 'Someshere in Dhaka, Bangladesh', 'assets/Images/profiles/1737190530_3.jpg', 'user', 1, '2025-01-18 08:55:30'),
(13, 'Mahmud Reza', 'fahad123@gmail.com', '$2y$10$jG6.GhCiC4S8g.hn/gtbhewxboAjGfHUxN/CEdQXcA37cHdgc0ade', '231231132', 'Dhaka,Bangladesh', 'assets/Images/profiles/1737190754_BlackPanther.jpg', 'admin', 1, '2025-01-18 08:59:14'),
(15, 'Person', 'person1@gmail.com', '$2y$10$/rMWvGGDS4TlwpQ6TCIEieU//POCona0dj6f8Hfg0jyG5ndNGg8Za', '123456678', 'dasdasd', 'assets/Images/profiles/1737419885_person1.jpg', 'user', 1, '2025-01-21 00:38:05'),
(16, 'Persona', 'person3@gmail.com', '$2y$10$cCWgEFU7ePAqCFi5te5abuAedJa0dv2.CJaCtI9s.zIqnxhhuYYdi', '3123123', 'dasdasd', 'assets/Images/profiles/1737419914_Person2.jpg', 'user', 1, '2025-01-21 00:38:34'),
(17, 'Personc', 'person32@gmail.com', '$2y$10$tP7CGmDigatNVuRf77n01uXoyKEahqHmbEiTJq.yLwOxE3PQ8HgCC', '31231231', 'adsdasda', 'assets/Images/profiles/1737419976_Person 3.jpg', 'user', 1, '2025-01-21 00:39:36'),
(18, 'Test', 'test@gmail.com', '$2y$10$YffCgj4fCxBQLDKbccqwk.Hz142CzsmwqLdI673G1Z3NTmRJqiaIe', '01648364956', 'Dhaka, Bangladesh', 'assets/Images/profiles/1737462435_wallpaperflare.com_wallpaper.jpg', 'user', 1, '2025-01-21 12:27:15'),
(19, 'Fahad', 'fahad@gmail.com', '$2y$10$Ha4vTONJeuc4lsBcg3fhMeKAyte4dCT7TYDz3bWH0vNcYQmLQmPdy', '0175476482', 'Somewhere in nowhere', 'assets/Images/profiles/1737474164_wallpaperflare.com_wallpaper (10).jpg', 'user', 1, '2025-01-21 15:42:44'),
(20, 'Mehdei', 'mehdi@gmail.com', '$2y$10$pWq7qiykMLPwrH/AxQ6urOv1EdNxeJwrr8dIA8gDFzm8rrmTrkf4q', '12312323', 'Dhaka', 'assets/Images/profiles/1737533408_anime2.gif', 'admin', 1, '2025-01-22 08:10:08'),
(21, 'eee', 'eeee@gmail.com', '$2y$10$qXIsUaLgb55xVbH8YZRzKeaS36suxNcIUA12sSVo9yfCgbzxiikpu', '01568177673', 'shei', 'assets/Images/profiles/1737537492_anime1.gif', 'user', 1, '2025-01-22 09:18:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `travel_packages`
--
ALTER TABLE `travel_packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `travel_packages`
--
ALTER TABLE `travel_packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `travel_packages` (`package_id`) ON DELETE SET NULL;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_3` FOREIGN KEY (`package_id`) REFERENCES `travel_packages` (`package_id`) ON DELETE CASCADE;

--
-- Constraints for table `travel_packages`
--
ALTER TABLE `travel_packages`
  ADD CONSTRAINT `travel_packages_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
