-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 10:14 AM
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
-- Database: `art_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(200) NOT NULL,
  `price` double NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `description` mediumtext NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `cart_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `item_name`, `price`, `date`, `description`, `image_url`, `cart_id`) VALUES
(6, 'Angry Girl', 100, '2025-06-15', 'girl at office', 'uploads/685ed5d709c31_ref2.jpg', NULL),
(9, 'boy', 1000, '2025-06-04', 'nice bangs', 'uploads/685f7050ce2c8_male.jpg', NULL),
(10, 'flower girl', 100, '2025-06-01', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ac leo ut dui vestibulum fringilla. Fusce aliquet magna nec aliquet vehicula. Phasellus tincidunt tortor neque, tempor pharetra magna accumsan quis. Nulla sed dui ultricies, rhoncus nulla vitae, aliquet ligula.', 'uploads/685f8e03d4520_girl14.jpg', 1),
(11, 'Wife', 200, '2025-06-03', 'medieval dress', 'uploads/685f7e5a5bc5f_dress5.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
