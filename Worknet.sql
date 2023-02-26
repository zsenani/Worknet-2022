-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 06, 2022 at 10:32 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Worknet`
--

-- --------------------------------------------------------

--
-- Table structure for table `Employee`
--

CREATE TABLE `Employee` (
  `id` int(11) NOT NULL,
  `emp_number` int(10) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `job_title` varchar(40) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Employee`
--

INSERT INTO `Employee` (`id`, `emp_number`, `first_name`, `last_name`, `job_title`, `password`) VALUES
(3, 1111111111, 'Njood', 'Mohammed', 'Sales Officer', '$2y$10$UgPC4l9P2GhGHa9D7yEINuORNBO8A12/AAqSlnGmkjA.RPHi8OaZS'),
(4, 1234567890, 'Aljwharah', 'Abdulaziz', 'Accountant', '$2y$10$vzBr27zEudT.MLL3yIo11.80RJRxqEXSnKFzrFJ3T6ixoqm1/USvS'),
(5, 987654321, 'Shaden', 'Yousef', 'HR Officer', '$2y$10$XfUezFpTql3Gcl1zTeFvouhTPOfechiR0zv3yQ8vUIXB29PhhBfqK'),
(6, 1111, 'leen', 'khalid', 'student', '$2y$10$I5B4Kr0gGVI9Tk10Ssj78.zznJM25.eim97hHA53QvLEHoV7fruLa');

-- --------------------------------------------------------

--
-- Table structure for table `Manager`
--

CREATE TABLE `Manager` (
  `id` int(10) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Manager`
--

INSERT INTO `Manager` (`id`, `first_name`, `last_name`, `username`, `password`) VALUES
(1111100000, 'Norah', 'Abdulaziz', 'naziz', '$2y$10$MX073Ebj/ZnI4w75GPpoY.ov0DhmIhQ690lZVhN3JBAaVhFECIKay');

-- --------------------------------------------------------

--
-- Table structure for table `Request`
--

CREATE TABLE `Request` (
  `id` int(10) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `service_id` varchar(10) NOT NULL,
  `description` varchar(600) NOT NULL,
  `attachment1` varchar(600) NOT NULL,
  `attachment2` varchar(600) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Request`
--

INSERT INTO `Request` (`id`, `emp_id`, `service_id`, `description`, `attachment1`, `attachment2`, `status`) VALUES
(14, 6, '2', 'test', '624d66715b6f34.04386363.png', '624d66715b7ca5.32512077.pdf', 'In progress'),
(15, 6, '4', 'test2', '', '', 'Approved'),
(16, 6, '5', 'test4', '624d66b2d3f6d1.54650019.pdf', '624d66b2d40150.90817857.pdf', 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `Service`
--

CREATE TABLE `Service` (
  `id` varchar(10) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Service`
--

INSERT INTO `Service` (`id`, `type`) VALUES
('1', 'Promotion'),
('2', 'Leave'),
('3', 'Resignation'),
('4', 'Allowance'),
('5', 'Health Insurance'),
('6', 'Other');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Employee`
--
ALTER TABLE `Employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emp_number` (`emp_number`);

--
-- Indexes for table `Manager`
--
ALTER TABLE `Manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `Request`
--
ALTER TABLE `Request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `Service`
--
ALTER TABLE `Service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Employee`
--
ALTER TABLE `Employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Manager`
--
ALTER TABLE `Manager`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1111100001;

--
-- AUTO_INCREMENT for table `Request`
--
ALTER TABLE `Request`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Request`
--
ALTER TABLE `Request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `Service` (`id`),
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`emp_id`) REFERENCES `Employee` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
