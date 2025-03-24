-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2025 at 08:15 AM
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
-- Database: `newfitlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Meet', 'meet@123'),
(2, 'admin', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_time` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `login_time`) VALUES
(1, 'Mitprajapati', 'pmit9810@outlook.com', '2025-03-23 16:09:07'),
(2, 'Prajapati Mit', 'mitprajapati72@gmail.com', '2025-03-23 18:19:06'),
(3, 'falak', 'falak12@gmail.com', '2025-03-24 03:05:00'),
(4, 'mit1', 'm11@gmail.com', '2025-03-24 06:11:47'),
(5, 'virat', 'kohli12@gmail.com', '2025-03-24 07:11:01');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `membership_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `membership_type` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `plan` varchar(100) DEFAULT NULL,
  `card` varchar(10) DEFAULT NULL,
  `expiry` varchar(10) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` decimal(10,2) NOT NULL,
  `card_number` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `email`, `plan`, `card`, `expiry`, `payment_date`, `amount`, `card_number`) VALUES
(1, 'Prajapati Niralben Mohanbhai', 'pmit9810@gmail.com', 'Basic', '4236', '2025-01', '2025-03-23 13:39:41', 0.00, ''),
(2, 'Prajapati Mit Mohanbhai', 'mzuck12@gmail.com', 'Basic', '4789', '2025-01', '2025-03-23 13:45:28', 0.00, ''),
(3, 'Prajapati krish ', 'ds001@gmail.com', 'Basic', '4205', '2025-01', '2025-03-23 22:42:29', 0.00, ''),
(5, 'deep', 'ds001@gmail.com', 'Basic', NULL, NULL, '2025-03-24 01:17:11', 999.00, ''),
(6, 'deep', 'ds001@gmail.com', 'Basic', NULL, NULL, '2025-03-24 01:17:17', 999.00, ''),
(7, 'deep', 'ds001@gmail.com', 'Basic', NULL, NULL, '2025-03-24 01:17:41', 999.00, ''),
(8, 'deep', 'ds001@gmail.com', 'Basic', NULL, NULL, '2025-03-24 01:38:12', 999.00, ''),
(9, 'deep', 'ds01@gmail.com', 'Basic', NULL, NULL, '2025-03-24 01:38:50', 999.00, ''),
(10, 'deep22', 'ds01@gmail.com', 'Standard', NULL, NULL, '2025-03-24 01:42:45', 1999.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `trainers`
--

CREATE TABLE `trainers` (
  `trainer_id` int(11) NOT NULL,
  `trainer_name` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `joined_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `joined_date`) VALUES
(4, 'meet', 'admin@gmail.com', '$2y$10$NdqtV1wqsQUoAf9C1bdzfO2stWy63roTQWTfZzc5ewd7louRPMtJS', '2025-03-23 15:59:28'),
(5, 'mit_p', 'mit11@gmail.com', '$2y$10$5iyG3FjLd0o0yAhXw/dqi.Y3THxNfNdpVmfRA1szKSSMedVXEhQ..', '2025-03-23 15:59:28'),
(6, 'deep_s', 'ds001@gmail.com', '$2y$10$25TgcGunWLkVPiuFeXnblOqBF1Enx7kf3QZd8m5E/MYtVAohNqD92', '2025-03-23 15:59:28'),
(7, 'krish', 'kp1@gmail.com', '$2y$10$snFCdgnFgBjQFCVYAt0eruUXBidZE/gdHzll00Te/kpsb8oh5qkYi', '2025-03-23 15:59:28'),
(8, 'John Doe', 'john@example.com', 'password123', '2025-03-23 15:59:28'),
(9, 'Jane Smith', 'jane@example.com', 'password456', '2025-03-23 15:59:28'),
(12, 'm', 'pm12@gmail.com', '$2y$10$YVMqjQD1ncULkZnJuz0Y5e/XFlMwdYs6lf/wQIvRkyOs9eshz9R0G', '2025-03-23 15:59:28'),
(13, 'pm', 'pm123@gmail.com', '$2y$10$P09dW2uAMM6kE9jB4pPGE.JZJu4uh3cMqApiWamFeFGW8DioeJipG', '2025-03-23 15:59:28'),
(15, 'd', 'ds0001@gmail.com', '$2y$10$amR6Z1EamhdxF0Ug8//f4eWe2kmJGslldVxT7DhaEWhGlEpkvi9dS', '2025-03-23 16:01:36'),
(16, 'Mitprajapati', 'pmit9810@outlook.com', '$2y$10$tsJXIqmi3q41/MPvlQBS.e2Z7RV9tHcEVmPODFgsuNJvaIiiK6o/2', '2025-03-23 16:05:47'),
(17, 'Prajapati Mit', 'mitprajapati72@gmail.com', '$2y$10$iiazvhQ8gzQK.DpfoFluA.cw4/zJm5Wk5lF6SggBgTxLMmLOMP8m.', '2025-03-23 18:18:44'),
(18, 'falak', 'falak12@gmail.com', '$2y$10$D6pZNZ9ZwoqcL4aqjUyIweuMVDdU5yz6aeNWP2YggGn7eAilkZsXW', '2025-03-24 03:04:48'),
(19, 'mit1', 'm11@gmail.com', '$2y$10$Rt5XByD5Ho5Qk3OGgFZ/MOi6TV.alDlcfyO7gVJsuOaTxnoARZBji', '2025-03-24 06:10:19'),
(20, 'virat', 'kohli12@gmail.com', '$2y$10$CAaG6fRh9H42epVgQgGn9un9gAPwcKX5oHb7PH2TYThO8dugMQ6/i', '2025-03-24 07:10:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`membership_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainer_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `membership_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `membership_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
