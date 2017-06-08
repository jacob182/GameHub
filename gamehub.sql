-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2017 at 06:59 PM
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
  `Comment_ID` int(11) UNSIGNED NOT NULL,
  `Vid_ID` int(11) UNSIGNED NOT NULL,
  `member_ID` int(11) UNSIGNED NOT NULL,
  `Comment_txt` varchar(100) NOT NULL,
  `Date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `Vid_ID`, `member_ID`, `Comment_txt`, `Date_added`) VALUES
(2, 10, 1, 'Comment 1', 1496935157),
(3, 10, 1, 'Comment 2', 1496935187),
(4, 10, 1, 'comment 3', 1496935194);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `follow_ID` int(11) UNSIGNED NOT NULL,
  `followingID` int(11) UNSIGNED NOT NULL,
  `followerID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follow_ID`, `followingID`, `followerID`) VALUES
(8, 1, 2),
(9, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `member_ID` int(11) UNSIGNED NOT NULL,
  `Username` varchar(12) NOT NULL DEFAULT '',
  `Password` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL DEFAULT '',
  `ClientImage` varchar(255) DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '1',
  `followers` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `following` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_ID`, `Username`, `Password`, `Email`, `ClientImage`, `Admin`, `followers`, `following`) VALUES
(1, 'link182', '68183c365dffc040q52k3133891r4c70x036v531bdwiya59afda268e054dc7155029ae154cad61ff8d5eb16c76a2e60ac2d2196e150a5be967889d9a2946239a8ecab29b81ec132c9af7f5683e5df63d', 'jacobcoorey@gmail.com', '../images/profile_images/Link182.jpg', 1, 1, 1),
(2, 'username', '22733038c58d53ab5re9gr999wjvtvg177hvg6s25s3e8rdg925a3b18556eb44bcfbe2195cfee02782d3e12e452e96f95da3035bb8908c98988f754398046ab0cc6fa65a7cda62e3eaf1368274e35a793', 'email@email.com', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `Session_ID` int(11) UNSIGNED NOT NULL,
  `member_ID` int(11) UNSIGNED NOT NULL,
  `Logged_in` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `Vid_ID` int(11) UNSIGNED NOT NULL,
  `member_ID` int(11) UNSIGNED NOT NULL,
  `Vid_name` varchar(30) NOT NULL,
  `Vid_url` varchar(100) NOT NULL,
  `Vid_description` varchar(100) NOT NULL,
  `Date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Vid_ID`, `member_ID`, `Vid_name`, `Vid_url`, `Vid_description`, `Date_added`) VALUES
(10, 1, 'Short video clip-nature.mp4', 'videos/uploads/NTE2MA==.mp4', '', 1496932879);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `Vid_ID` (`Vid_ID`),
  ADD KEY `member_ID` (`member_ID`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`follow_ID`),
  ADD KEY `followingID` (`followingID`),
  ADD KEY `followerID` (`followerID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`Session_ID`),
  ADD KEY `member_ID` (`member_ID`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`Vid_ID`),
  ADD KEY `member_ID` (`member_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `follow_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `Session_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `Vid_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Vid_ID`) REFERENCES `videos` (`Vid_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`member_ID`) REFERENCES `members` (`member_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`followingID`) REFERENCES `members` (`member_ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `followers_ibfk_2` FOREIGN KEY (`followerID`) REFERENCES `members` (`member_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`member_ID`) REFERENCES `members` (`member_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`member_ID`) REFERENCES `members` (`member_ID`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
