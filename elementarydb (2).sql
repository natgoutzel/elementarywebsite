-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2015 at 06:46 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elementarydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `lessonprogram`
--

CREATE TABLE `lessonprogram` (
  `lessonprogram_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `class` varchar(10) CHARACTER SET utf8 NOT NULL,
  `lessonprogram_file` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lessonprogram`
--

INSERT INTO `lessonprogram` (`lessonprogram_id`, `user_id`, `class`, `lessonprogram_file`) VALUES
(0, 0, 'A1', 0x6675636b20796f75206d616c616b61);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_type` int(11) NOT NULL,
  `post_title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `post_body` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `image` blob,
  `video` longblob,
  `post_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_firstname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `staff_lastname` varchar(45) CHARACTER SET utf8 COLLATE utf8_german2_ci NOT NULL,
  `specialty` varchar(45) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `user_id`, `staff_firstname`, `staff_lastname`, `specialty`) VALUES
(1, 0, 'kwnstantinos', 'katakouzinos', 'vizantinologos'),
(28, 0, 'xristoforos ', 'papakaliatis', 'dasskalos');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `user_lastname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `user_firstname` varchar(45) CHARACTER SET utf8 NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `user_lastname`, `user_firstname`, `admin`, `status`) VALUES
(0, 'admin', '12345', 'admin', 'admin', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lessonprogram`
--
ALTER TABLE `lessonprogram`
  ADD PRIMARY KEY (`lessonprogram_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `inderxpost` (`post_type`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lessonprogram`
--
ALTER TABLE `lessonprogram`
  ADD CONSTRAINT `lessonprogram_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
