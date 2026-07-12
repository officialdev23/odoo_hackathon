-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 12, 2026 at 06:32 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assetflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE IF NOT EXISTS `assets` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_code` varchar(30) NOT NULL,
  `asset_name` varchar(150) NOT NULL,
  `category_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_cost` decimal(10,2) DEFAULT NULL,
  `vendor` varchar(100) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `asset_status` enum('Available','Allocated','Maintenance','Retired') DEFAULT 'Available',
  `remarks` text DEFAULT NULL,
  `asset_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`asset_id`),
  UNIQUE KEY `asset_code` (`asset_code`),
  KEY `category_id` (`category_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`asset_id`, `asset_code`, `asset_name`, `category_id`, `department_id`, `purchase_date`, `purchase_cost`, `vendor`, `serial_number`, `asset_status`, `remarks`, `asset_image`, `created_at`) VALUES
(2, 'AST-000001', 'HP EliteBook 840 G9', 1, 1, '2026-07-12', '75000.00', 'HP', 'HP-840G9-0001', 'Allocated', 'Assigned to Finance Team', '1783843055_unnamed (2).png', '2026-07-12 06:15:30'),
(3, 'AST-000003', 'Dell Latitude 5440', 1, 1, '2026-07-11', '68500.00', 'Dell India', 'DELL5440-02', 'Available', 'Development Team Laptop', NULL, '2026-07-12 07:11:22'),
(4, 'AST-000004', 'Lenovo ThinkPad E16', 1, 1, '2026-07-13', '64000.00', 'Lenovo India', 'LEN-E16-0003', 'Available', 'Developer workstation', NULL, '2026-07-12 07:28:06'),
(8, 'AST-000005', 'ASUS ROG Strix G16', 1, 1, '2026-07-13', '135000.00', 'ASUS India', 'ASUS-G16-001', 'Available', 'Graphics Team Laptop', '1783842508_default.jpg', '2026-07-12 07:48:28'),
(9, 'AST-000009', 'nokia', 2, 1, '2026-07-02', '500000.00', 'janesh', 'n/a', 'Allocated', 'none', '1783853924_Full Stack Developer - JD.jpeg', '2026-07-12 10:58:44'),
(10, 'AST-000010', 'redmi', 1, 1, '2026-07-02', '506.32', 'manya', '', 'Allocated', 'not', 'default.png', '2026-07-12 11:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `asset_allocations`
--

DROP TABLE IF EXISTS `asset_allocations`;
CREATE TABLE IF NOT EXISTS `asset_allocations` (
  `allocation_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `allocation_date` date NOT NULL,
  `expected_return` date DEFAULT NULL,
  `actual_return` date DEFAULT NULL,
  `allocation_status` enum('Allocated','Returned','Overdue') DEFAULT 'Allocated',
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`allocation_id`),
  KEY `asset_id` (`asset_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_allocations`
--

INSERT INTO `asset_allocations` (`allocation_id`, `asset_id`, `employee_id`, `allocation_date`, `expected_return`, `actual_return`, `allocation_status`, `remarks`, `created_at`) VALUES
(1, 2, 2, '2026-07-12', '2026-07-18', '2026-07-12', 'Allocated', 'Gave for Formatting', '2026-07-12 09:07:01');

-- --------------------------------------------------------

--
-- Table structure for table `asset_categories`
--

DROP TABLE IF EXISTS `asset_categories`;
CREATE TABLE IF NOT EXISTS `asset_categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset_categories`
--

INSERT INTO `asset_categories` (`category_id`, `category_name`, `description`, `status`, `created_at`) VALUES
(1, 'Electronics', 'Electronic Devices', 'Active', '2026-07-12 05:51:22'),
(2, 'mobile', '', 'Active', '2026-07-12 10:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `manager_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `department_code` varchar(20) DEFAULT NULL,
  `parent_department` int(11) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`department_id`),
  UNIQUE KEY `department_name` (`department_name`),
  KEY `parent_department` (`parent_department`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `manager_name`, `description`, `department_code`, `parent_department`, `status`, `created_at`) VALUES
(1, 'Information Technology', 'John Doe', 'This is the IT dept', 'IT', NULL, 'Active', '2026-07-12 05:41:20'),
(2, 'Human Resource', 'Jane Doe', 'HR Department', 'HR', NULL, 'Active', '2026-07-12 08:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `employee_code` (`employee_code`),
  UNIQUE KEY `email` (`email`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_code`, `first_name`, `last_name`, `email`, `phone`, `department_id`, `designation`, `status`, `created_at`) VALUES
(1, 'EMP-0001', 'Rahul', 'Sharma', 'rahul.sharma@assetflow.com', '9876543210', 1, 'Software Engineer', 'Active', '2026-07-12 08:49:35'),
(2, 'EMP-0002', 'Priya', 'Mehta', 'priya.mehta@assetflow.com', '9876543211', 2, 'HR Executive', 'Active', '2026-07-12 08:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`notification_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `reset_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`reset_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `description`, `created_at`) VALUES
(1, 'Admin', 'System Administrator', '2026-07-12 04:02:44'),
(2, 'Asset Manager', 'Handles Assets', '2026-07-12 04:02:44'),
(3, 'Department Head', 'Department Manager', '2026-07-12 04:02:44'),
(4, 'Employee', 'Normal User', '2026-07-12 04:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_code` varchar(20) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'default.png',
  `status` enum('Active','Inactive','Suspended') DEFAULT 'Active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `employee_code` (`employee_code`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `employee_code`, `first_name`, `last_name`, `email`, `phone`, `password`, `role_id`, `department_id`, `profile_image`, `status`, `last_login`, `created_at`) VALUES
(1, 'EMP00001', 'Admin', 'User', 'admin@assetflow.com', NULL, '$2y$10$9IbVdHqJCixJ08Q1FoAfDOC/rS/NSiKnCnwj1ESwkecNkUKwFKrXK', 1, NULL, 'default.png', 'Active', NULL, '2026-07-12 04:16:19'),
(2, 'EMP1783830771', 'John', 'Jack', 'john@test.com', '123456', '$2y$10$YBP6.BbNvDK1KvBU8ko.W.TzDVJQ3qy.V8J3bRfybBdi0ogSz2YrS', 4, NULL, 'default.png', 'Active', NULL, '2026-07-12 04:32:51'),
(3, 'EMP1783852439', 'janesh', 'neav', 'janesh@gmail.com', '7666491809', '$2y$10$WX9GLIKlh6OYxqNNEuUXX.b3dQ0BSF3n0gS2CzhQem9Ry12pxdppe', 4, NULL, 'default.png', 'Active', NULL, '2026-07-12 10:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `assets_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `asset_categories` (`category_id`),
  ADD CONSTRAINT `assets_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `asset_allocations`
--
ALTER TABLE `asset_allocations`
  ADD CONSTRAINT `asset_allocations_ibfk_1` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`asset_id`),
  ADD CONSTRAINT `asset_allocations_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`parent_department`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
