-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 01:37 PM
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
-- Database: `purrfectpetsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminaccount`
--

CREATE TABLE `adminaccount` (
  `adminID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `pic_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminaccount`
--

INSERT INTO `adminaccount` (`adminID`, `username`, `password`, `pic_url`) VALUES
(1, 'jayn95', 'sv216', 'Song Kang.png');

-- --------------------------------------------------------

--
-- Table structure for table `admin_permission`
--

CREATE TABLE `admin_permission` (
  `adminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_posts`
--

CREATE TABLE `admin_posts` (
  `postID` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `picture` text NOT NULL,
  `date_created` datetime NOT NULL,
  `petID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_posts`
--

INSERT INTO `admin_posts` (`postID`, `title`, `content`, `picture`, `date_created`, `petID`, `adminID`) VALUES
(1, 'Dogs Beware!', 'This is only for testing purposes. No animals were harmed.', 'meme2.jpg', '2024-04-18 02:50:09', 21, 1),
(2, 'Natural lng na!', 'Check out this creature down below!⬇️', 'meme1.jpg', '2024-04-18 02:50:09', 16, 1),
(3, 'Charrr!<3', 'So trueee!', 'memes3.jpg', '2024-04-18 05:27:18', 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `animalprofiles`
--

CREATE TABLE `animalprofiles` (
  `petID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `routeLink` text NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animalprofiles`
--

INSERT INTO `animalprofiles` (`petID`, `name`, `breed`, `description`, `routeLink`, `image_url`) VALUES
(16, 'Yam', 'dog', 'joo', 'ROUTE-661e01f4408a15.37803009.png', 'IMG-661e01f440b3e2.54824886.jpg'),
(17, 'katy', 'maine coon', 'Fiesty!', 'ROUTE-661e0230e2b8b7.92851362.png', 'IMG-661e0230e2e951.02939581.jpg'),
(18, 'Mimi', 'Maltese', 'Cutieee!', 'ROUTE-661e025ee967f9.25156317.png', 'IMG-661e025ee9c7f3.17813975.jpg'),
(19, 'Riri', 'Husky', 'Like a wolf!', 'ROUTE-661e314015e2b4.81418807.png', 'IMG-661e3140162d22.78553741.jpg'),
(21, 'Pido', 'Aspin', 'Favorite ka Taga-West! (PS: Image may not reflect the the actual person or animal.)', 'ROUTE-661e4132eadc06.02573548.png', 'IMG-661e4132eb1400.79743027.png');

-- --------------------------------------------------------

--
-- Table structure for table `forum_subject`
--

CREATE TABLE `forum_subject` (
  `content_id` int(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `content` varchar(200) NOT NULL,
  `comment` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_subject`
--

INSERT INTO `forum_subject` (`content_id`, `subject`, `content`, `comment`) VALUES
(1, '', '', ''),
(2, 'Pinky', 'Bkkahhhhhhhh', '');

-- --------------------------------------------------------

--
-- Table structure for table `post_reactions`
--

CREATE TABLE `post_reactions` (
  `postReactID` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `time_reacted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_reactions`
--

INSERT INTO `post_reactions` (`postReactID`, `petID`, `userID`, `time_reacted`) VALUES
(17, 19, 1, '2024-04-20 00:21:20');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reacted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `petID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`reactionID`, `userID`, `reacted_at`, `petID`) VALUES
(1, 3, '2024-04-17 01:46:18', 21),
(2, 3, '2024-04-17 01:46:34', 21),
(25, 1, '2024-04-20 00:33:57', 19),
(26, 1, '2024-04-20 00:34:47', 21);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_prof` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`userID`, `username`, `first_name`, `last_name`, `email_address`, `password`, `image_prof`) VALUES
(1, 'lily08', 'Lily', 'Cruz', 'lilycruz@gmail.com', 'ivy13', 'Rarity.jpg'),
(2, 'orion18', 'Orion', 'Hunter', 'orionthehunter@gmail.com', 'orion012', 'RB.jpg'),
(3, 'lovesomeone<3', 'Lukas', 'Graham', 'lukasgraham@gmail.com', 'real45', 'TS.jpg'),
(4, 'ilavkat06', 'Pika', 'Chu', 'katsu234@gmail.com', 'meh4h', 'Fluttershy.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaccount`
--
ALTER TABLE `adminaccount`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `admin_posts`
--
ALTER TABLE `admin_posts`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `fk_cat` (`petID`),
  ADD KEY `fk_administration` (`adminID`);

--
-- Indexes for table `animalprofiles`
--
ALTER TABLE `animalprofiles`
  ADD PRIMARY KEY (`petID`);

--
-- Indexes for table `forum_subject`
--
ALTER TABLE `forum_subject`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD PRIMARY KEY (`postReactID`),
  ADD KEY `fk_enduser` (`userID`),
  ADD KEY `fk_dog` (`petID`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`),
  ADD KEY `fk_user` (`userID`),
  ADD KEY `fk_animal` (`petID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminaccount`
--
ALTER TABLE `adminaccount`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_permission`
--
ALTER TABLE `admin_permission`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animalprofiles`
--
ALTER TABLE `animalprofiles`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `forum_subject`
--
ALTER TABLE `forum_subject`
  MODIFY `content_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post_reactions`
--
ALTER TABLE `post_reactions`
  MODIFY `postReactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_permission`
--
ALTER TABLE `admin_permission`
  ADD CONSTRAINT `admin_permission_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `adminaccount` (`adminID`);

--
-- Constraints for table `admin_posts`
--
ALTER TABLE `admin_posts`
  ADD CONSTRAINT `fk_administration` FOREIGN KEY (`adminID`) REFERENCES `adminaccount` (`adminID`),
  ADD CONSTRAINT `fk_cat` FOREIGN KEY (`petID`) REFERENCES `animalprofiles` (`petID`);

--
-- Constraints for table `post_reactions`
--
ALTER TABLE `post_reactions`
  ADD CONSTRAINT `fk_dog` FOREIGN KEY (`petID`) REFERENCES `animalprofiles` (`petID`),
  ADD CONSTRAINT `fk_enduser` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userID`);

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `fk_animal` FOREIGN KEY (`petID`) REFERENCES `animalprofiles` (`petID`),
  ADD CONSTRAINT `fk_pet` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userID`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
