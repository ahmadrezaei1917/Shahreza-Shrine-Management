-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 01, 2025 at 03:48 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astan`
--

-- --------------------------------------------------------

--
-- Table structure for table `as_shifts`
--

DROP TABLE IF EXISTS `as_shifts`;
CREATE TABLE IF NOT EXISTS `as_shifts` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'آیدی',
  `shift_date` date NOT NULL COMMENT 'تاریخ شیفت',
  `shift_start1` time NOT NULL COMMENT 'شروع شیفت اول',
  `shift_end1` time NOT NULL COMMENT 'پایان شیفت اول',
  `shift_start2` time NOT NULL COMMENT 'شروع شیفت دوم',
  `shift_end2` time NOT NULL COMMENT 'پایان شیفت دوم',
  `shift_start3` time NOT NULL COMMENT 'شروع شیفت سوم',
  `shift_end3` time NOT NULL COMMENT 'پایان شیفت سوم',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci COMMENT 'توضیحات',
  `max_users1` int DEFAULT '1' COMMENT 'حداکثر کاربران برای شیفت اول',
  `max_users2` int DEFAULT '1' COMMENT 'حداکثر کاربران برای شیفت دوم',
  `max_users3` int DEFAULT '1' COMMENT 'حداکثر کاربران برای شیفت سوم',
  `created_by` int DEFAULT NULL COMMENT 'کاربر ایجادکننده',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'تاریخ ایجاد',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'تاریخ آپدیت',
  PRIMARY KEY (`id`),
  UNIQUE KEY `shift_date` (`shift_date`),
  KEY `created_by` (`created_by`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `as_shifts`
--

INSERT INTO `as_shifts` (`id`, `shift_date`, `shift_start1`, `shift_end1`, `shift_start2`, `shift_end2`, `shift_start3`, `shift_end3`, `description`, `max_users1`, `max_users2`, `max_users3`, `created_by`, `created_at`, `updated_at`) VALUES
(45, '2025-04-18', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(44, '2025-04-17', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(43, '2025-04-16', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(42, '2025-04-15', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(41, '2025-04-14', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(40, '2025-04-13', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(39, '2025-04-12', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(38, '2025-04-11', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(37, '2025-04-10', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(36, '2025-04-09', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(35, '2025-04-08', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(34, '2025-04-07', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(33, '2025-04-06', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(32, '2025-04-05', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(31, '2025-04-04', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(46, '2025-04-19', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(47, '2025-04-20', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(48, '2025-04-21', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(49, '2025-04-22', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(50, '2025-04-23', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(51, '2025-04-24', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(52, '2025-04-25', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(53, '2025-04-26', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(54, '2025-04-27', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(55, '2025-04-28', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(56, '2025-04-29', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(57, '2025-04-30', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(58, '2025-05-01', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(59, '2025-05-02', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23'),
(60, '2025-05-03', '08:00:00', '09:30:00', '10:00:00', '11:30:00', '17:00:00', '18:30:00', 'شیفت پیش فرض', 1, 1, 1, 1190356244, '2025-04-04 17:40:23', '2025-04-04 17:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `as_user`
--

DROP TABLE IF EXISTS `as_user`;
CREATE TABLE IF NOT EXISTS `as_user` (
  `u_code` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'کدملی',
  `u_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'رمز عبور',
  `u_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام',
  `u_family` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام خانوادگی',
  `u_father_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نام پدر',
  `u_phone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'شماره تماس',
  `u_virtual` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci DEFAULT NULL COMMENT 'شماره تماس مجازی',
  `u_gender` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'جنسیت',
  `u_marriage` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'وضعیت تاهل',
  `u_nation` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'تابعیت',
  `u_religion` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'دین',
  `u_sect` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'مذهب',
  `u_education` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'مدرک تحصیلی',
  `u_state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'استان',
  `u_city` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'شهرستان محل زندگی',
  `u_type` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'نوع کاربر',
  PRIMARY KEY (`u_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `as_user`
--

INSERT INTO `as_user` (`u_code`, `u_password`, `u_name`, `u_family`, `u_father_name`, `u_phone`, `u_virtual`, `u_gender`, `u_marriage`, `u_nation`, `u_religion`, `u_sect`, `u_education`, `u_state`, `u_city`, `u_type`) VALUES
('1199044695', '$2y$10$j/4auz6wT9W5ZiFQzmPRtunOl6ywS0h5MuMVFl6rdUrDcv2MN33n.', 'ناد علی', 'کافی', 'ابوالقاسم', '09133017518', '', 'مرد', 'متاهل', 'ایرانی', 'اسلام', 'شیعه', 'لیسانس', 'اصفهان', 'شهرضا', 'مدیر آستان'),
('1190356244', '$2y$10$bP2EmYAyGLcpKyCuixKmfeg8anN6XK.OoupkYNukMYkyJb6TNJziG', 'بنیامین', 'شکوهی', 'مجید', '09140393871', '', 'مرد', 'مجرد', 'ایرانی', 'اسلام', 'شیعه', 'فوق دیپلم', 'اصفهان', 'شهرضا', 'پشتیبان'),
('9074694500', '$2y$10$JnKGVNM0bkXDiDQEEQfdEetMMmGgsjSVwHVJUk9QRySB8zh4C3QQ.', 'احمد', 'رضایی', 'محمد صادق', '09015578565', '09015578565', 'مرد', 'مجرد', 'اتباع خارجی', 'اسلام', 'شیعه', 'لیسانس', 'اصفهان', 'شهرضا', 'پشتیبان'),
('1190123456', '$2y$10$xzjdpBy8iDSMBmEEAnr4DeX90CtAwbfff.NfnbV51BI9ySNo.BPzy', 'رضا', 'کریمی', 'نعمت الله', '09123456789', '09039046492', 'مرد', 'متاهل', 'ایرانی', 'اسلام', 'شیعه', 'سیکل', 'آذربايجان غربي', 'اروميه', 'خادم افتخاری'),
('1209405865', '$2y$10$wEAcFy3EvrCJIuOFfKwq7ewltJi8C4p46devZUURtlDIm9jnr5mea', 'علی اکبر', 'قرقانی', 'علی', '09132205317', '', 'مرد', 'متاهل', 'ایرانی', 'اسلام', 'شیعه', 'لیسانس', 'اصفهان', 'شهرضا', 'مسئول خادمین افتخاری'),
('1200123456', '$2y$10$N.xFRC4jB4cg3yfGRd1uTuJhcCJpOVcL.wbrRW8iOmHMp1LYAypOK', 'فاطمه', 'تست', 'علی', '09123456789', '', 'زن', 'مجرد', 'ایرانی', 'اسلام', 'شیعه', 'در حال تحصیل', 'اصفهان', 'شهرضا', 'مسئول خادمین افتخاری');

-- --------------------------------------------------------

--
-- Table structure for table `as_user_shifts`
--

DROP TABLE IF EXISTS `as_user_shifts`;
CREATE TABLE IF NOT EXISTS `as_user_shifts` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'آیدی',
  `user_id` int NOT NULL COMMENT 'کد کاربر',
  `shift_id` int NOT NULL COMMENT 'کد شیفت',
  `shift_number` tinyint NOT NULL COMMENT 'شیفت اول = 1 - شیفت دوم = 2 - شیفت سوم = 3',
  `registered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'تاریخ ثبت',
  `shift_status` varchar(40) COLLATE utf8mb4_persian_ci NOT NULL COMMENT 'وضعیت شیفت (حاضر یا غایب)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`shift_id`,`shift_number`),
  KEY `shift_id` (`shift_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

--
-- Dumping data for table `as_user_shifts`
--

INSERT INTO `as_user_shifts` (`id`, `user_id`, `shift_id`, `shift_number`, `registered_at`, `shift_status`) VALUES
(5, 1190123456, 38, 3, '2025-04-11 18:23:12', 'حضور'),
(8, 1190123456, 39, 2, '2025-04-12 05:31:43', 'حضور'),
(10, 1190123456, 41, 1, '2025-04-14 13:49:04', 'غیبت'),
(11, 1190123456, 53, 3, '2025-04-25 14:53:24', 'حضور'),
(12, 1190123456, 53, 1, '2025-04-25 15:00:19', 'غیبت');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
