-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 01:07 PM
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
-- Database: `hotel_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discount_type` varchar(100) NOT NULL,
  `discount_name` varchar(255) DEFAULT NULL,
  `value` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','pending','expired') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_type`, `discount_name`, `value`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'percentage', 'winter offer', 10.00, '2025-09-01', '2025-09-30', 'active', '2025-09-10 09:39:35', '2025-10-11 14:58:07', NULL),
(2, 'amount', 'summer offfer', 1500.00, '2025-10-01', '2025-10-15', 'active', '2025-09-10 09:39:35', '2025-10-11 14:58:21', NULL),
(3, 'percentage', 'rmazn offer', 40.00, '2025-11-15', '2025-11-20', 'expired', '2025-10-09 05:31:20', '2025-10-11 14:58:44', '2025-10-10 19:25:12'),
(4, 'amount', 'sumer offff', 1000.00, '2025-10-15', '2025-10-20', 'active', '2025-10-09 05:50:25', '2025-10-11 14:59:53', '2025-10-09 11:20:03'),
(5, 'percentage', 'winter offf', 30.00, '2025-10-20', '2025-10-25', 'pending', '2025-10-09 06:20:48', '2025-10-11 15:00:05', '2025-10-09 11:20:55'),
(6, 'percentage', 'Summer Sale', 10.00, '2025-10-25', '2025-10-30', 'active', '2025-10-09 12:03:02', '2025-10-10 14:25:17', '2025-10-10 19:25:17'),
(7, 'percentage', 'winter ', 50.00, '2025-10-10', '2025-10-15', 'expired', '2025-10-10 14:02:18', '2025-10-17 08:58:23', NULL),
(8, 'amount', 'summer', 500.00, '2025-10-10', '2025-10-15', 'active', '2025-10-10 14:18:05', '2025-10-17 08:58:34', NULL),
(9, 'percentage', 'winter sumer offer', 29.00, '2025-10-01', '2025-10-10', 'expired', '2025-10-10 14:20:34', '2025-10-11 14:59:30', NULL),
(10, 'percentage', 'sumeerr', 10.00, '2025-10-10', '2025-10-15', 'expired', '2025-10-10 14:24:44', '2025-10-10 14:24:44', NULL),
(11, 'amount', 'sumer winter', 10.00, '2025-10-10', '2025-10-15', 'expired', '2025-10-10 14:25:42', '2025-10-10 14:25:42', NULL),
(12, 'percentage', 'winter ', 20.00, '2025-10-17', '2025-10-18', 'active', '2025-10-17 09:01:19', '2025-10-17 09:01:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_type` enum('individual','corporate') NOT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `user_id`, `guest_type`, `id_number`, `created_at`, `updated_at`) VALUES
(1, 2, 'individual', 'CNIC-12345-6789012-3', '2025-09-10 10:09:50', '2025-09-10 10:10:30'),
(2, NULL, 'corporate', 'TAX-REG-998877', '2025-09-10 10:09:50', '2025-09-10 10:10:39');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `contact_no` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `hotel_name`, `address`, `contact_no`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Royal Residency', 'Mall Road, Lahore', '042-444-555-667', '2025-09-10 09:06:53', '2025-10-07 07:10:37', NULL),
(4, 'Mountain Inn', '123 Main Street, Lahore', '+92 42 111 123 458', '2025-10-06 07:03:32', '2025-10-09 09:21:11', '2025-10-09 14:21:11'),
(6, 'Mountain In', 'Islamabad', '03001234565', '2025-10-07 07:11:13', '2025-10-07 07:11:13', NULL),
(7, 'Seaside ', 'pindiii', '07473647688', '2025-10-09 09:15:55', '2025-10-09 09:21:04', NULL),
(8, 'Seaside Retreat', 'kotli', '07473647673', '2025-10-09 09:18:30', '2025-10-09 09:18:30', NULL),
(9, 'Retreat', 'pindi', '07473647679', '2025-10-09 09:25:27', '2025-10-09 09:25:31', '2025-10-09 14:25:31');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','paid','failed','refunded') DEFAULT 'pending',
  `method` enum('cash','card','bank_transfer') NOT NULL,
  `is_discount_applied` tinyint(1) DEFAULT 0,
  `txn_ref` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(3, 'book_room'),
(2, 'manage_hotels'),
(1, 'manage_users'),
(4, 'view_profile');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `hotel_code` varchar(50) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `status` enum('active','cancelled','completed') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `hotel_code`, `user_id`, `guest_id`, `hotel_id`, `room_id`, `staff_id`, `discount_id`, `check_in`, `check_out`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'RES-1004', 0, 4, 2, 202, 3, 2, '2025-10-10', '2025-10-15', 'cancelled', '2025-10-03 09:16:50', '2025-10-07 16:37:06', '2025-10-07 16:37:06'),
(4, 'RES-2003', 5, 1, 1, 3, 2, NULL, '2025-09-25', '2025-09-30', 'completed', '2025-10-03 09:26:40', '2025-10-08 08:38:36', '2025-10-08 08:38:36'),
(5, 'RES-027', 28, 27, 1, 1, NULL, NULL, '2025-10-01', '2025-10-05', 'active', '2025-10-03 10:21:53', '2025-10-08 08:38:40', '2025-10-08 08:38:40'),
(7, 'RES-1007', 29, 29, 1, 2, NULL, NULL, '2025-10-05', '2025-10-08', 'active', '2025-10-05 14:28:03', '2025-10-08 08:38:44', '2025-10-08 08:38:44'),
(8, 'RES-20011', 0, 0, 0, 108, NULL, NULL, '2025-11-01', '2025-11-06', 'active', '2025-10-07 09:21:07', '2025-10-08 06:47:29', '2025-10-08 06:47:29'),
(9, 'RES-20023', 0, 0, 0, 108, NULL, NULL, '2025-11-01', '2025-11-05', 'active', '2025-10-07 09:43:33', '2025-10-08 06:47:42', '2025-10-08 06:47:42'),
(10, 'RES-20026', 0, 0, 0, 110, NULL, NULL, '2025-11-02', '2025-11-06', 'active', '2025-10-07 10:12:04', '2025-10-08 06:47:46', '2025-10-08 06:47:46'),
(11, 'RES-1113', 0, 0, 0, 111, NULL, NULL, '2025-11-05', '2025-11-10', '', '2025-10-07 10:23:33', '2025-10-07 16:38:38', '2025-10-07 16:38:38'),
(12, 'RES-1114', 0, 0, 0, 113, NULL, NULL, '2025-11-10', '2025-11-15', '', '2025-10-07 10:33:44', '2025-10-08 06:47:50', '2025-10-08 06:47:50'),
(13, 'RES-1112', 0, 0, 0, 115, NULL, NULL, '2323-12-21', '2122-02-22', '', '2025-10-07 10:39:08', '2025-10-08 06:47:54', '2025-10-08 06:47:54'),
(14, 'RES-1115', 0, 0, 0, 6, NULL, NULL, '2025-11-15', '2025-11-20', 'active', '2025-10-07 10:39:45', '2025-10-08 06:49:36', '2025-10-08 06:46:48'),
(16, 'RES-11188', 20, 0, 6, 0, NULL, NULL, '2025-12-06', '2025-12-22', 'active', '2025-10-07 11:43:48', '2025-10-08 10:50:07', '2025-10-08 10:50:07'),
(17, 'RES-1119', 18, 0, 6, 0, NULL, NULL, '2025-11-25', '2025-11-30', 'active', '2025-10-07 11:46:20', '2025-10-11 16:05:29', '2025-10-11 16:05:29'),
(19, 'RES-11124', 19, 0, 2, 1, NULL, NULL, '2222-12-12', '2222-02-11', 'active', '2025-10-07 12:08:55', '2025-10-08 09:05:07', '2025-10-08 09:05:07'),
(20, 'RES-20024', 16, 0, 2, 16, NULL, 2, '2223-09-11', '2023-10-12', 'active', '2025-10-08 09:13:53', '2025-10-11 16:05:48', '2025-10-11 16:05:48'),
(21, 'RES-20012', 14, 0, 2, 17, NULL, NULL, '2025-12-20', '2025-12-25', 'active', '2025-10-08 10:06:19', '2025-10-16 05:44:46', '2025-10-16 05:44:46'),
(22, 'RES-12', 21, 0, 7, 18, NULL, NULL, '2025-11-06', '2025-11-10', 'completed', '2025-10-09 09:39:01', '2025-10-09 09:39:31', '2025-10-09 09:39:31'),
(23, 'RES-1', 28, 0, 8, 18, NULL, NULL, '2025-11-02', '2025-11-06', 'active', '2025-10-09 11:45:10', '2025-10-16 05:44:50', '2025-10-16 05:44:50'),
(24, 'RES-1122', 7, 0, 2, 17, NULL, 8, '2025-10-10', '2025-10-15', 'cancelled', '2025-10-10 15:03:10', '2025-10-16 05:44:54', '2025-10-16 05:44:54'),
(25, 'RES-1100', 22, 0, 2, 18, NULL, 10, '2025-10-10', '2025-10-15', 'completed', '2025-10-11 14:34:56', '2025-10-16 05:44:57', '2025-10-16 05:44:57'),
(26, 'RES-101', 28, 0, 7, 17, NULL, 1, '2025-10-15', '2025-10-20', 'active', '2025-10-15 10:04:52', '2025-10-16 05:45:02', '2025-10-16 05:45:02'),
(27, 'RES-102', 28, 0, 6, 17, NULL, 2, '2025-10-20', '2025-10-25', 'cancelled', '2025-10-15 12:06:06', '2025-10-16 05:45:05', '2025-10-16 05:45:05'),
(28, 'RES-103', 28, 0, 2, 18, NULL, 10, '2025-10-20', '2025-10-25', 'completed', '2025-10-15 13:13:38', '2025-10-16 05:45:07', '2025-10-16 05:45:07'),
(29, 'RES-105', 37, 0, 7, 18, NULL, 2, '2025-10-15', '2025-10-16', 'active', '2025-10-15 18:45:46', '2025-10-16 05:46:08', '2025-10-16 05:46:08'),
(30, 'RES-106', 37, 0, 7, 17, NULL, 8, '2025-10-17', '2025-10-18', 'active', '2025-10-15 19:40:51', '2025-10-16 05:46:11', '2025-10-16 05:46:11'),
(31, 'RES-1099', 39, 0, 2, 18, NULL, 7, '2025-10-16', '2025-10-17', 'completed', '2025-10-16 05:47:27', '2025-10-17 08:51:13', NULL),
(32, 'RES-111', 39, 0, 8, 18, NULL, 11, '2025-10-16', '2025-10-20', 'active', '2025-10-16 05:48:48', '2025-10-16 05:48:48', NULL),
(33, 'RES-201', 41, 0, 7, 18, NULL, 10, '2025-10-10', '2025-10-20', 'active', '2025-10-16 06:09:08', '2025-10-17 06:33:15', '0000-00-00 00:00:00'),
(35, 'RES-2004', 41, 0, 2, 18, NULL, 11, '2025-10-20', '2025-10-25', 'active', '2025-10-16 06:29:27', '2025-10-17 06:33:22', '0000-00-00 00:00:00'),
(36, 'RES-3002', 28, 0, 6, 17, NULL, 11, '2025-10-15', '2025-10-20', 'active', '2025-10-17 05:00:09', '2025-10-17 06:39:52', '0000-00-00 00:00:00'),
(37, 'RES-1002', 41, 0, 7, 17, NULL, 11, '2025-10-17', '2025-10-18', 'cancelled', '2025-10-17 06:34:26', '2025-10-17 08:51:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservation_rooms`
--

CREATE TABLE `reservation_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `guest_count` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_services`
--

CREATE TABLE `reservation_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '2025-09-30 10:32:52', '2025-09-30 10:32:52'),
(2, 'admin', '2025-09-30 10:32:52', '2025-09-30 10:32:52'),
(3, 'staff', '2025-09-30 10:32:52', '2025-09-30 10:32:52'),
(4, 'user', '2025-09-30 10:32:52', '2025-09-30 10:32:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 1),
(6, 2, 2),
(7, 2, 3),
(8, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(20) NOT NULL,
  `floor` int(11) NOT NULL,
  `status` enum('available','booked','maintenance') NOT NULL,
  `beds` tinyint(3) UNSIGNED NOT NULL,
  `max_guests` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `room_number`, `floor`, `status`, `beds`, `max_guests`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 2, '202', 2, 'available', 2, 4, '2025-09-10 09:36:23', '2025-10-07 07:29:41', '2025-10-07 12:29:41'),
(5, 4, '2', 3, '', 4, 2, '2025-10-06 07:03:42', '2025-10-06 08:55:25', '2025-10-06 13:55:25'),
(16, 2, '101', 1, 'available', 2, 4, '2025-10-08 09:09:38', '2025-10-08 09:09:38', NULL),
(17, 4, '1033', 2, 'booked', 3, 3, '2025-10-08 09:14:27', '2025-10-17 08:36:33', NULL),
(18, 9, '108', 3, 'booked', 5, 5, '2025-10-09 09:27:32', '2025-10-09 09:35:14', NULL),
(19, 7, '1011', 2, 'available', 3, 3, '2025-10-09 09:36:07', '2025-10-09 09:36:15', '2025-10-09 14:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `room_prices`
--

CREATE TABLE `room_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_prices`
--

INSERT INTO `room_prices` (`id`, `hotel_id`, `room_id`, `rate`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 5500.00, NULL, NULL, '2025-09-10 09:37:37', '2025-09-10 09:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(150) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `price` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `status`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Airport Pickup', 'active', 2500.00, '2025-09-10 09:38:43', '2025-09-10 09:38:43', NULL),
(2, 'Laundry Service', 'active', 500.00, '2025-09-10 09:38:43', '2025-09-10 09:38:43', NULL),
(3, 'clean room', 'active', 100.00, '2025-10-09 07:14:38', '2025-10-09 07:34:08', NULL),
(4, 'clean room', '', 100.00, '2025-10-09 07:17:23', '2025-10-09 08:30:43', '2025-10-09 13:30:43'),
(5, 'clean room', '', 100.00, '2025-10-09 07:18:04', '2025-10-09 08:30:55', '2025-10-09 13:30:55'),
(6, 'clean room', 'active', 110.00, '2025-10-09 07:19:38', '2025-10-17 06:48:08', NULL),
(7, 'tv', '', 200.00, '2025-10-09 07:20:35', '2025-10-17 06:47:52', '2025-10-17 11:47:52'),
(8, 'AC', 'active', 300.00, '2025-10-09 07:23:12', '2025-10-09 07:23:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `position` varchar(100) NOT NULL,
  `salary` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `user_id`, `position`, `salary`, `created_at`, `updated_at`) VALUES
(5, 2, 'Hotel Manager', 85000.00, '2025-09-10 09:05:18', '2025-09-10 09:05:18'),
(6, 3, 'Front Desk Staff', 40000.00, '2025-09-10 09:05:18', '2025-09-10 09:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) UNSIGNED DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `user_email`, `password`, `contact_no`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 2, 'asif', 'Manager', 'manager@example.com', 'ans1234', '03007654321', 'Lahore Branch', 'active', '2025-09-10 09:35:37', '2025-09-29 06:00:45', '2025-09-29 06:00:45'),
(4, 1, 'anees', 'haider ', 'admin@example.com', '', '03001234567', 'islambad', 'inactive', '2025-09-27 07:39:03', '2025-10-05 17:16:52', '2025-10-05 17:16:52'),
(5, 1, 'ateeq', 'had', 'staff@example.com', '', '03001234567', 'islmbad', 'active', '2025-09-28 07:28:21', '2025-10-05 17:17:25', '2025-10-05 17:17:25'),
(7, 1, 'anees', 'haider', 'anees1@gmail.com', '$2y$10$D4EJs7uKtgZ52055bcBHPef5Eu80ELKHRQwb93AdpxQECVNBLMwgW', '03001234567', 'kotli', 'active', '2025-09-29 08:37:29', '2025-10-15 06:11:55', NULL),
(8, 1, 'anes', 'had', 'anes123@gmail.com', '$2y$10$bFgXNRdD1gGG/5zeN2atjOrlm5n7qFfxWUvgQJiKlTjjuCBMQ.2Ja', '', NULL, 'active', '2025-09-29 08:42:32', '2025-10-17 06:41:05', '2025-10-17 06:41:05'),
(9, 1, 'anees', 'haid', 'anes21@gmail.com', '$2y$10$9UEi5euTJdb47J0ul3f08uRWq2.6HeWdjUDKlmXgNQ72vbkZ8ZnB.', '03001234567', 'ajk', 'active', '2025-09-29 08:50:00', '2025-10-17 06:44:34', NULL),
(11, 1, 'anees', 'haider', 'ane123@gmail.com', '$2y$10$MA8WkcQ0QMPrFjB2USSJFuPN9je2Wd.ai7d7JjC8zMbtiCjsxiq5.', '', NULL, 'active', '2025-09-29 09:09:30', '2025-09-29 09:09:30', NULL),
(12, 1, 'asif', 'haider', 'asif123@gmail.cm', '$2y$10$AZ2bCqGKHys0N97avZpyZOruIK9DZ8tg5XC92YvzadqTzsnZ1j4Ii', '', NULL, 'active', '2025-09-29 09:10:30', '2025-09-29 09:10:30', NULL),
(14, NULL, 'aasif', 'jutt', 'asif@gmail.com', '$2y$10$JKSqHRUxdZbvEunCxitpnelCQ3cNhV074FepIpOIAZ.Lm6wwOme/q', '', NULL, 'active', '2025-09-29 09:11:38', '2025-10-17 06:40:49', '2025-10-17 06:40:49'),
(15, 1, 'usman', 'raja', 'usman13@gmail.com', '$2y$10$zBROOr/9Y4/Tm8RxcRHPAu.V8qGueIe20AV17qjIdlaxMPTcTCG.i', '03007654321', NULL, 'active', '2025-09-29 09:30:11', '2025-09-29 09:30:11', NULL),
(16, 1, 'ate', 'had', 'ate123@gmail.com', '$2y$10$jG98mAUqpA.D.A9FJ2NPM.Wp0l9/MymWgt91qh8ckTq7oYtzTU4i6', '07473647673', NULL, 'active', '2025-09-29 10:56:46', '2025-09-29 10:56:46', NULL),
(17, 1, 'anees', 'hiader', 'ans12@gmail.com', '$2y$10$myQSTl09fe0jS4xNrYmczuQvJvjwb4bV39iOof1cx2MU/BA/IEhDe', '03001234565', NULL, 'active', '2025-09-29 11:28:57', '2025-10-17 06:40:57', '2025-10-17 06:40:57'),
(18, 1, 'asim', 'raja', 'asim12@gmail.com', '$2y$10$yr4mKJoSUr3gOPOlk/rSrOFm5Wyia2nvMSC96pYr.360yIwsyY/Qq', '030012345666', NULL, 'active', '2025-09-29 11:30:13', '2025-09-29 11:30:13', NULL),
(19, 1, 'atif', 'haider', 'atif12@gmail.com', '$2y$10$.TOvyShP/NArX7ODdGyT1.2a6YFwVIjdKWGHxuveQugBTO28HPBdm', '07473647673', NULL, 'active', '2025-09-29 12:02:45', '2025-09-29 12:02:45', NULL),
(20, 1, 'waleed', 'raja', 'waleed@gmail.com', '$2y$10$HCBHb3JJmvWIDR2FuQIgm.PdQ5lmXHDMewV9Y8.7izwgVRQbCAvZO', '03272623626', NULL, 'active', '2025-09-29 12:31:21', '2025-09-29 12:31:21', NULL),
(21, 1, 'usman', 'jutt', 'usman@gmail.com', '$2y$10$SmbA2VIs68XPNuM5X9BeneYl.j.rcjIHlg4dMXgzoT2TADeSbyCse', '03007654321', NULL, 'active', '2025-09-30 05:45:34', '2025-09-30 05:45:34', NULL),
(22, 2, 'anees', 'haider', 'had123@gmail.com', '$2y$10$Q38DqA41yfQ4i3Ace9zdWufb/3jTjsX6qfucsuvyvci5SQddeXnZ.', '030012345666', NULL, 'active', '2025-09-30 07:12:42', '2025-09-30 07:12:42', NULL),
(23, 1, 'ane', 'had', 'ane@gmail.com', '$2y$10$LbxQFEtKbNT5vvIry9jBZ.jm.0uLcnxmRafhzj0BZ6/TgLGNPABvi', '03001234565', NULL, 'active', '2025-09-30 10:53:27', '2025-09-30 10:53:27', NULL),
(24, 2, 'anee', 'haider', 'anee@gmail.com', '$2y$10$Nh9lXSwsc8l.CIt8/SQ20u2VX0hUU2MngFKLmFw/pwoNYayQ4KcsW', '03007654321', NULL, 'active', '2025-10-01 06:42:11', '2025-10-01 06:42:11', NULL),
(26, 4, 'asim', 'jutt', 'asim@gmail.com', '$2y$10$c/zYhm17TWbmfs0QZfTPquqwpjhXgcdfuL8Fbwm3j2RtQC4qCaQHK', '030012345666', NULL, 'active', '2025-10-01 10:17:53', '2025-10-01 10:17:53', NULL),
(27, 4, 'ans', 'had', 'ans@gmail.com', '$2y$10$VdfKd6bk/NkJrFjF8OVzguC2S/CkRph7pjvBO2B9K5WkbLtcwxGE.', '03001234565', 'kotli ajk', 'active', '2025-10-03 05:47:39', '2025-10-03 06:19:27', NULL),
(28, 4, 'waleed', 'raja', 'waleed1@gmail.com', '$2y$10$mo4s3fc0GtaeR3avac5Ik.Luct8N5MmiZ6A9AW.f2hHneMsS0ED/G', '03007654321', 'kotli ajk', 'inactive', '2025-10-04 10:57:32', '2025-10-15 07:32:32', NULL),
(29, 4, 'basit', 'raja', 'basit1@gmail.com', '$2y$10$YWGY7zem/z7w3VivSCjfMekWnUksd/x/WUQO4c7CuQ.CwsaIRx.1a', '07473647673', NULL, 'active', '2025-10-05 14:14:28', '2025-10-05 14:14:28', NULL),
(30, 4, 'aneess', 'hads', 'aneess@gmail.com', '$2y$10$aTVkTt9/7XdhCYZCcvgbnOpR5AKx5jeplLLl1Gkfe7AO9zaQSeebu', '03007654321', NULL, 'active', '2025-10-09 10:31:38', '2025-10-09 10:31:38', NULL),
(34, 4, 'ateeqq', 'jutt', 'ateeqq@gmail.com', '$2y$10$O8W0F0BnuFMSvyRxhtWd3.Pw9bvdDkUAC8/Bpv7ohp4bfOaPTGOkS', '03007654329', 'islambadd', 'active', '2025-10-09 11:04:36', '2025-10-09 11:08:03', NULL),
(35, 2, 'anee', 'hadie', 'ane2@gmail.com', '$2y$10$LA0S7BErRUDzSYoq7fZKAuV.zQEXhLtVW4df49HKxQ9ivcZQ/jL9e', '03007654321', NULL, 'active', '2025-10-15 05:48:50', '2025-10-15 05:48:50', NULL),
(36, 2, 'anes', 'jhad', 'anes4@gmail.com', '$2y$10$Sf3./via4MS2KoiMP3tvd.rj.l4x2bSVuiaAYMQH8JSfzQLiTMhzC', '07473647673', NULL, 'active', '2025-10-15 06:10:11', '2025-10-15 06:10:11', NULL),
(37, 4, 'tayyab', 'tah', 'tayyab@gmail.com', '$2y$10$iWuuAbji/Ew.ax/Fl0Qnve43.CA.mFEf2f4a3uMivwyCt/9Vb0cru', '07473647673', NULL, 'active', '2025-10-15 18:28:59', '2025-10-15 18:28:59', NULL),
(38, 4, 'tayyab ', 'jut', 'tayyab1@gmail.com', '$2y$10$EoKwRf2u97YgQ8tycITcIe4HTbCgl5IA28elD8/Foo5VS0AZY2KEK', '07473647673', NULL, 'active', '2025-10-16 05:45:39', '2025-10-16 05:45:39', NULL),
(39, 4, 'tayyab', 'raja', 'tayyab2@gmail.com', '$2y$10$8rf0szVTz/Xo92Mc.WBUK.oY7gXNJ/.tvxSyOuONPRp4QRonB2Y/.', '03007654321', NULL, 'active', '2025-10-16 05:46:39', '2025-10-16 05:46:39', NULL),
(40, 4, 'tayyab', 'malik', 'tayyab3@gail.com', '$2y$10$jHz0qRFnsvPTMuBvrWWHVOeXInzwJB.jp9DUGn6MaBBjufmjl6jYW', '03001234565', NULL, 'active', '2025-10-16 05:49:45', '2025-10-17 06:45:46', '2025-10-17 06:45:46'),
(41, 4, 'tayyab', 'raja', 'tayyab4@gail.com', '$2y$10$kXRSE4vCZ5ITPUgmrKodDuf0kvx9Ko7Orjymr7b01SqMiVyXDPECW', '03007654321', 'ajk', 'active', '2025-10-16 05:50:29', '2025-10-16 06:47:26', NULL),
(42, 2, 'ane', 'anes', 'ane5@gmail.c0m', '$2y$10$gkEOk8OA3Aow4eM9q2Ge8uhTkhuzIFMoJQOsq/DMEx1UiIt4vmCcu', '03001234565', NULL, 'active', '2025-10-16 07:17:19', '2025-10-16 07:17:19', NULL),
(43, 2, 'ahsan', 'jut', 'ahsan@gmail.com', '$2y$10$/maONrD0vuzO7kZY3glYBOAFyxqwJ8ZAMuDRnJDWyVdSQSqhUKzh.', '03001234565', NULL, 'active', '2025-10-16 07:19:05', '2025-10-16 07:19:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_hotel`
--

CREATE TABLE `user_hotel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `hotel_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_hotel`
--

INSERT INTO `user_hotel` (`id`, `user_id`, `hotel_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-09-10 09:10:18', '2025-09-10 09:10:18'),
(2, 3, 2, '2025-09-10 09:10:18', '2025-09-10 09:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user_id`, `permission_id`) VALUES
(1, 5, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_guests_user` (`user_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`hotel_name`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_payments_reservation` (`reservation_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`hotel_code`),
  ADD UNIQUE KEY `hotel_code` (`hotel_code`);

--
-- Indexes for table `reservation_rooms`
--
ALTER TABLE `reservation_rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`,`room_id`),
  ADD KEY `fk_reservation_rooms_room` (`room_id`);

--
-- Indexes for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reservation_id` (`reservation_id`,`service_id`,`date`),
  ADD KEY `fk_reservation_services_service` (`service_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_hotel_room` (`hotel_id`,`room_number`);

--
-- Indexes for table `room_prices`
--
ALTER TABLE `room_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_room_prices` (`hotel_id`,`room_id`,`start_date`,`end_date`),
  ADD KEY `fk_roomprices_room` (`room_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`user_email`),
  ADD KEY `fk_users_role` (`role_id`);

--
-- Indexes for table `user_hotel`
--
ALTER TABLE `user_hotel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_user_hotel` (`user_id`,`hotel_id`),
  ADD KEY `fk_userhotel_hotel` (`hotel_id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `reservation_rooms`
--
ALTER TABLE `reservation_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_services`
--
ALTER TABLE `reservation_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `room_prices`
--
ALTER TABLE `room_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_hotel`
--
ALTER TABLE `user_hotel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `fk_guests_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `reservation_rooms`
--
ALTER TABLE `reservation_rooms`
  ADD CONSTRAINT `fk_reservation_rooms_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation_services`
--
ALTER TABLE `reservation_services`
  ADD CONSTRAINT `fk_reservation_services_service` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `fk_permission` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `room_prices`
--
ALTER TABLE `room_prices`
  ADD CONSTRAINT `fk_roomprices_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_roomprices_room` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `fk_permission_user` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
