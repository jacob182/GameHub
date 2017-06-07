-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 06, 2017 at 11:17 AM
-- Server version: 5.5.52-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamehub`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `Comment_ID` int(11) NOT NULL,
  `Vid_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Comment_txt` varchar(100) NOT NULL,
  `Date_added` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `follow_ID` int(11) NOT NULL,
  `followingID` varchar(12) NOT NULL,
  `followerID` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `Username` varchar(12) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ClientImage` varchar(255) DEFAULT NULL,
  `Description` varchar(150) DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '1',
  `followers` int(11) NOT NULL,
  `following` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Username`, `Email`, `Password`, `ClientImage`, `Description`, `Admin`, `followers`, `following`) VALUES
('ianishungry', 'iankoala@gmail.com', 'a66fded995b220cb0b0ff053166fe101e8181ycd6r5uuuiokyn7zp8iypgv70c3lqf831afb4af6765ac1560db5597c4edfa2901f44c2f5eb01eaa82f862b4e3ac9e613f59fe1797c39eee88dac96f861c', '../images/profile_images/ianishungry.jpg', NULL, 0, 0, 0),
('link182', 'jacobdcoorey@gmail.com', 'b540e075er67gxb0x25293e1v98nog2fsb02ji023eb2d8efdd1bc73d94f14d5a4331a2027e13f1bf037ec91fa00f565f7154a31da40871e56bd71fc064c588e59704a1dcf6a98ba0fa038e6261eaf83a', '../images/profile_images/link182.png', NULL, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `Session_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Logged_in` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `Vid_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Vid_name` varchar(30) NOT NULL,
  `Vid_url` varchar(100) NOT NULL,
  `Vid_description` varchar(100) NOT NULL,
  `Date_added` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Vid_ID`, `Username`, `Vid_name`, `Vid_url`, `Vid_description`, `Date_added`) VALUES
(9, 'link182', 'Short video clip-nature.mp4 (1', 'videos/uploads/ODE0MTU=.mp4', '', 1496712575);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `Vid_ID` (`Vid_ID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follow_ID`),
  ADD KEY `following_ID` (`followingID`),
  ADD KEY `follower_ID` (`followerID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`Session_ID`),
  ADD KEY `Username` (`Username`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`Vid_ID`),
  ADD KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `follow_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `Session_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `Vid_ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Vid_ID`) REFERENCES `videos` (`Vid_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `account_delete_cmnt` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`followingID`) REFERENCES `members` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`followerID`) REFERENCES `members` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`) ON DELETE CASCADE;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `account_delete_vid` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
