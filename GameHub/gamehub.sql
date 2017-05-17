-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Apr 15, 2017 at 11:07 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23
=======
-- Generation Time: May 08, 2017 at 06:10 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13
>>>>>>> origin/master

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `Cat_ID` int(11) NOT NULL,
  `Cat_name` int(20) NOT NULL,
  `Cat_description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
<<<<<<< HEAD
=======
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
(11, 18, 'link182', '1231', 1494216283),
(12, 18, 'link182', '1231', 1494216339),
(13, 18, 'link182', '124323', 1494216345),
(14, 19, 'link182', 'XD NEW COMMENT', 1494216379),
(15, 18, 'username', 'NICE VID LOSER', 1494216429);

-- --------------------------------------------------------

--
>>>>>>> origin/master
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Client_ID` int(11) UNSIGNED NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ClientImage` varchar(255) NOT NULL,
  `Description` varchar(150) DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

<<<<<<< HEAD
INSERT INTO `members` (`Client_ID`, `Email`, `Username`, `Password`, `ClientImage`, `Description`, `Admin`) VALUES
(2, 'jacobcoorey@gmail.com', 'link182', '$2y$10$XnSRnMAOI9mLuGvn.SoF7O6Tea5j.RD2O8QyIveEyAd5pStbgKvcG', '', NULL, 0);
=======
INSERT INTO `members` (`Username`, `Email`, `Password`, `ClientImage`, `Description`, `Admin`) VALUES
('link182', 'jacobcoorey@gmail.com', '$2y$10$uGNiGzxUNiIhEMIOiO3Wlu0QH/xBY7FuGKl.MkZ1.BywbydXobXZ.', '', NULL, 0),
('Username', 'email@email.com', '$2y$10$E8Klka1tLkIWymSF5i.5R.r6Ca3rA7H4uLTQrksxZStIgozbq.L4C', '', NULL, 0);
>>>>>>> origin/master

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `Post_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `Cat_ID` int(11) NOT NULL,
  `Post_date` datetime NOT NULL,
  `Post_description` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

<<<<<<< HEAD
CREATE TABLE `sessions` (
  `Session_ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `Logged_in` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
=======
CREATE TABLE `videos` (
  `Vid_ID` int(11) NOT NULL,
  `Username` varchar(10) NOT NULL,
  `Vid_name` varchar(30) NOT NULL,
  `Vid_url` varchar(100) NOT NULL,
  `Vid_description` varchar(100) NOT NULL,
  `Date_added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Vid_ID`, `Username`, `Vid_name`, `Vid_url`, `Vid_description`, `Date_added`) VALUES
(18, 'link182', 'test.mp4', 'videos/uploads/Mjk3Mzc=.mp4', 'Description of video', 1494210177),
(19, 'link182', 'test.mp4', 'videos/uploads/NDA4NDI=.mp4', 'XD MY DUDES', 1494213470);

--
>>>>>>> origin/master
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`Cat_ID`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`Client_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Post_ID`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`Session_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `Cat_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
<<<<<<< HEAD
ALTER TABLE `members`
  MODIFY `Client_ID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT;
=======
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
>>>>>>> origin/master
--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `Session_ID` int(11) NOT NULL AUTO_INCREMENT;
<<<<<<< HEAD
=======
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `Vid_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
>>>>>>> origin/master
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
