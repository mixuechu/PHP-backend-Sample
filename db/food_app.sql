-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2019 at 08:26 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food_app`
--
-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `staff_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_category`
--
INSERT INTO `staff_category` (`id`, `category_name`, `created_at`) VALUES ('1', 'Admin', '2019-04-01 22:14:50');
-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--


CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `staff_token` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`category_id`, `staff_token`, `name`, `email`, `password`, `created_at`) VALUES 
('1', 'CUOF9qJKvMoB5D3y', '123123', '123123@123123.com', '$2y$10$4ecwHpjo.iHo5UQWgZ0DFOVAJGKFCvFgTYG5E.deOO9iWy6U2M0te', '2019-04-01 22:14:50');


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `auth_key` varchar(100) NOT NULL,
  `forgotpassword_token` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin pw:123123`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `logo`, `auth_key`, `forgotpassword_token`, `created_at`, `updated_at`) VALUES
(1, '123123', '123123@123123.com', '$2y$10$4ecwHpjo.iHo5UQWgZ0DFOVAJGKFCvFgTYG5E.deOO9iWy6U2M0te', '', '', '', '2019-02-17 07:37:15', '2019-02-17 10:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cuisine_type`
--

CREATE TABLE `cuisine_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuisine_type`
--

INSERT INTO `cuisine_type` (`id`, `name`, `created_at`) VALUES
(1, 'Testing1234', '2019-02-17 15:24:31');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `users_token` varchar(255) NOT NULL,
  `fcm_token` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favourite_dishes`
--

CREATE TABLE `favourite_dishes` (
  `id` int(11) NOT NULL,
  `users_token` varchar(255) NOT NULL,
  `users_favourites` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favourite_dishes`
--

INSERT INTO `favourite_dishes` (`id`, `users_token`, `users_favourites`) VALUES
(1, 'NL9UX0FuZM2ITJWcCts3pvA4jKdeY16GlVfOokbgHDQnw7hyE5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `food_dishes`
--

CREATE TABLE `food_dishes` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `dish_image` varchar(255) NOT NULL,
  `dish_name` varchar(255) NOT NULL,
  `dish_description` varchar(1000) NOT NULL,
  `dish_price` int(11) NOT NULL,
  `total_likes` int(11) NOT NULL,
  `is_label_exist` tinyint(4) NOT NULL,
  `label_id` int(11) NOT NULL,
  `cuisine_type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_dishes`
--

INSERT INTO `food_dishes` (`id`, `restaurant_id`, `dish_image`, `dish_name`, `dish_description`, `dish_price`, `total_likes`, `is_label_exist`, `label_id`, `cuisine_type`, `created_at`) VALUES
(2, 2, '15505877813359.jpg', 'adsadasd22', 'dasdasd', 400, 0, 0, 3, '1', '2019-02-19 14:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `color`, `description`, `created_at`) VALUES
(1, '#211ee3', 'Test12', '2019-02-17 10:12:40'),
(3, '#e0148f', 'Testing234', '2019-02-19 09:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `bg_image` varchar(255) NOT NULL,
  `open_time` time NOT NULL,
  `close_time` time NOT NULL,
  `description` varchar(1000) NOT NULL,
  `food_type` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `profile_image`, `bg_image`, `open_time`, `close_time`, `description`, `food_type`, `contact_no`, `address`, `created_at`) VALUES
(2, 'sdfdsfdsf', '1550580626632.jpg', '15505806261072.jpg', '12:58:00', '11:58:00', 'fsdfsdfd', '1', '324234234234', 'fdsfsdf', '2019-02-19 12:50:26'),
(3, 'fdsfsdfds', '15505879424560.jpg', '15505879427745.jpg', '20:52:00', '06:05:00', '435345345', '1', '534534534', 'fdsfsdf', '2019-02-19 14:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `users_token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `location`, `mobile`, `profile_image`, `users_token`, `created_at`) VALUES
(1, 'Bansi', 'Test', '879988873838', 'abc.jpg', 'NL9UX0FuZM2ITJWcCts3pvA4jKdeY16GlVfOokbgHDQnw7hyE5', '2019-02-20 07:39:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `staff_category`
--
ALTER TABLE `staff_category`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `cuisine_type`
--
ALTER TABLE `cuisine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite_dishes`
--
ALTER TABLE `favourite_dishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_dishes`
--
ALTER TABLE `food_dishes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `staff_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cuisine_type`
--
ALTER TABLE `cuisine_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `favourite_dishes`
--
ALTER TABLE `favourite_dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `food_dishes`
--
ALTER TABLE `food_dishes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
