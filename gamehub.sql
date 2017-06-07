-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 05:09 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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

CREATE TABLE `comments` (
  `Comment_ID` int(11) NOT NULL,
  `Vid_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Comment_txt` varchar(100) NOT NULL,
  `Date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `Vid_ID`, `Username`, `Comment_txt`, `Date_added`) VALUES
(7, 11, 'link182', 'comment', 1496843751),
(8, 11, 'link182', 'comment', 1496843906),
(9, 11, 'link182', 'comment', 1496843910);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `follow_ID` int(11) NOT NULL,
  `followingID` varchar(12) DEFAULT NULL,
  `followerID` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follow_ID`, `followingID`, `followerID`) VALUES
(5, 'link182', 'username'),
(6, 'username', 'link182');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Username` varchar(12) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ClientImage` varchar(255) DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '1',
  `followers` int(11) NOT NULL DEFAULT '0',
  `following` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`Username`, `Email`, `Password`, `ClientImage`, `Admin`, `followers`, `following`) VALUES
('link182', 'jacobcoorey@gmail.com', 'f07a2acd1f939e7e68p19t87stazz139nt54tk683hqqffh37295d183345ea3a2d749e314d1aef3f7c83328cf2eb449cb39747df435cd6e7680a9daa62212b38fc01c7f7b7552f55c1ea442b0e5040278', '../images/profile_images/link182.jpg', 1, 1, 1),
('username', 'user@gmail.com', '08a38c4d37d35252bpikwtd4uk57i8mr0u6mbm48011qxoqy9593ffb507fc289ea040f92a9e13a74cf2b59d06868b02284e864ce4fd9c1685ce03f7615d7e05bba66df0c235180fa7721297e1dd777dce', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `Session_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Logged_in` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `Vid_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Vid_name` varchar(30) NOT NULL,
  `Vid_url` varchar(100) NOT NULL,
  `Vid_description` varchar(100) DEFAULT NULL,
  `Date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Vid_ID`, `Username`, `Vid_name`, `Vid_url`, `Vid_description`, `Date_added`) VALUES
(11, 'link182', 'Short video clip-nature.mp4.mp', 'videos/uploads/MjY3Nzkx.mp4', 'Video Description', 1496838264);

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
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `follow_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `Session_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `Vid_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `account_delete_cmnt` FOREIGN KEY (`Username`) REFERENCES `members` (`Username`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Vid_ID`) REFERENCES `videos` (`Vid_ID`) ON DELETE CASCADE;

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
