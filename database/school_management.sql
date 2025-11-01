-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2025 at 08:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `class_code` varchar(50) NOT NULL,
  `section` varchar(50) DEFAULT NULL,
  `class_teacher` varchar(100) DEFAULT NULL,
  `max_students` int(11) DEFAULT 0,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `class_code`, `section`, `class_teacher`, `max_students`, `status`, `created_at`) VALUES
(25, 'form one', 'CLS-E19F27', 'A', 'Abdinaasir Mohamed', 100, 'Active', '2025-10-31 16:35:11'),
(26, 'Form two', 'CLS-EE3E50', 'A', 'Abdinaasir Mohamed', 100, 'Active', '2025-10-31 16:53:51');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `teacher_name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `subject_code`, `class_name`, `teacher_name`, `status`, `created_at`) VALUES
(20, 'ENGLISH', 'ENG708', 'form one', 'Abdinaasir Mohamed', 'Active', '2025-10-31 16:52:36'),
(21, 'SOMALI', 'SOM339', 'form one', 'Abdinaasir Mohamed', 'Active', '2025-10-31 16:53:22'),
(22, 'Islamic', 'ISL715', 'Form two', 'Abdinaasir Mohamed', 'Active', '2025-10-31 16:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `Subjects` varchar(255) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `classes` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT '../assets/images/users/default.jpg',
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `salary` decimal(10,2) DEFAULT 0.00,
  `national_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `full_name`, `email`, `phone`, `Subjects`, `designation`, `classes`, `profile_image`, `status`, `created_at`, `salary`, `national_id`) VALUES
(31, 'Abdinaasir Mohamed', 'qoryooley839@gmail.com', '123', '', 'English', 'Classes 4,5,6,9', '/SMS_BARWAAQO/assets/images/person.jpg', 'Active', '2025-10-28 13:21:44', 200.00, '87977');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `day` varchar(20) NOT NULL,
  `period_number` int(11) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `subject_name` varchar(100) NOT NULL,
  `teacher_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `class_name`, `day`, `period_number`, `start_time`, `end_time`, `subject_name`, `teacher_name`, `created_at`) VALUES
(1, 'Class 1', 'Saturday', 1, '07:20:00', '08:00:00', 'Mathematics', 'Mr. Abdi', '2025-10-31 19:39:10'),
(2, 'Class 2', 'Saturday', 1, '07:20:00', '08:00:00', 'English', 'Ms. Aisha', '2025-10-31 19:35:55'),
(3, 'Class 3', 'Saturday', 1, '07:20:00', '08:00:00', 'Science', 'Mr. Omar', '2025-10-31 19:37:18'),
(4, 'Form 1', 'Saturday', 1, NULL, NULL, 'Biology', 'Mr. Hassan', '2025-10-31 18:44:52'),
(5, 'Class 1', 'Sunday', 2, NULL, NULL, 'English', 'Ms. Asha', '2025-10-31 18:44:52'),
(6, 'Class 2', 'Sunday', 2, NULL, NULL, 'Mathematics', 'Mr. Abdi', '2025-10-31 18:44:52'),
(7, 'Form 1', 'Sunday', 2, NULL, NULL, 'Chemistry', 'Mr. Yusuf', '2025-10-31 18:44:52'),
(8, 'Form 2', 'Sunday', 2, NULL, NULL, 'Physics', 'Mr. Khalid', '2025-10-31 18:44:52'),
(9, 'Class 3', 'Monday', 1, NULL, NULL, 'Mathematics', 'Mr. Abdi', '2025-10-31 18:44:52'),
(10, 'Class 4', 'Monday', 1, NULL, NULL, 'Science', 'Mr. Omar', '2025-10-31 18:44:52'),
(11, 'Form 3', 'Monday', 1, NULL, NULL, 'English', 'Ms. Fatima', '2025-10-31 18:44:52'),
(12, 'Form 4', 'Monday', 1, NULL, NULL, 'Biology', 'Mr. Hassan', '2025-10-31 18:44:52'),
(13, 'Class 1', 'Tuesday', 3, NULL, NULL, 'Islamic Studies', 'Mr. Ali', '2025-10-31 18:44:52'),
(14, 'Class 2', 'Tuesday', 3, NULL, NULL, 'Somali', 'Ms. Zainab', '2025-10-31 18:44:52'),
(15, 'Form 1', 'Tuesday', 3, NULL, NULL, 'Geography', 'Mr. Ibrahim', '2025-10-31 18:44:52'),
(16, 'Form 2', 'Tuesday', 3, NULL, NULL, 'History', 'Ms. Maryan', '2025-10-31 18:44:52'),
(17, 'Class 5', 'Wednesday', 1, NULL, NULL, 'Mathematics', 'Mr. Abdi', '2025-10-31 18:44:52'),
(18, 'Class 6', 'Wednesday', 1, NULL, NULL, 'English', 'Ms. Asha', '2025-10-31 18:44:52'),
(19, 'Form 3', 'Wednesday', 1, NULL, NULL, 'Chemistry', 'Mr. Yusuf', '2025-10-31 18:44:52'),
(20, 'Form 4', 'Wednesday', 1, NULL, NULL, 'Physics', 'Mr. Khalid', '2025-10-31 18:44:52'),
(21, 'Class 1', 'Saturday', 2, '08:00:00', '08:40:00', 'English', 'Mohamed ali', '2025-10-31 19:45:07'),
(22, 'Class 2', 'Saturday', 2, '08:00:00', '08:40:00', 'Tarbiyo', 'nuur ali', '2025-10-31 19:54:03'),
(23, 'Class 3', 'Saturday', 2, '08:00:00', '00:00:08', 'English', 'muno', '2025-10-31 19:38:51'),
(24, 'Class 4', 'Saturday', 1, '07:20:00', '00:00:08', 'ICT', 'naasir', '2025-10-31 19:39:26'),
(25, 'Class 4', 'Saturday', 2, '08:00:00', '00:00:08', 'English', 'cali', '2025-10-31 19:39:40'),
(26, 'Class 5', 'Saturday', 1, '07:20:00', '08:00:00', 'Techno', 'fartuun aadan', '2025-10-31 19:51:21'),
(27, 'Class 5', 'Saturday', 2, '08:00:00', '00:00:08', 'xisaab', 'cali aadan', '2025-10-31 19:40:11'),
(28, 'Class 6', 'Saturday', 1, '07:20:00', '00:00:08', 'somali', 'muuse maxamed', '2025-10-31 19:40:23'),
(29, 'Class 6', 'Saturday', 2, '08:00:00', '00:00:08', 'saynis', 'maxamed aadan', '2025-10-31 19:41:04'),
(30, 'Class 7', 'Saturday', 1, '07:20:00', '00:00:08', 'English', 'nuur cali', '2025-10-31 19:41:16'),
(31, 'Class 7', 'Saturday', 2, '08:00:00', '00:00:08', 'Cilmiga bulshada', 'ibraahim aadan', '2025-10-31 19:41:38'),
(32, 'Class 1', 'Saturday', 4, '09:20:00', '00:00:10', '', '', '2025-10-31 19:43:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
