-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 06:14 PM
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
  `pic_url` text NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminaccount`
--

INSERT INTO `adminaccount` (`adminID`, `username`, `password`, `pic_url`, `first_name`, `last_name`) VALUES
(1, 'jayn95', 'sv216', 'Song Kang.png', 'Jay', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `animalprofiles`
--

CREATE TABLE `animalprofiles` (
  `petID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `breed` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animalprofiles`
--

INSERT INTO `animalprofiles` (`petID`, `name`, `breed`, `description`, `image_url`) VALUES
(16, 'Yam', 'dog', 'joo', 'uploads/IMG-661e01f440b3e2.54824886.jpg'),
(17, 'katy', 'maine coon', 'Fiesty!', 'uploads/IMG-661e0230e2e951.02939581.jpg'),
(18, 'Mimi', 'Maltese', 'Cutieee!', 'uploads/IMG-661e025ee9c7f3.17813975.jpg'),
(19, 'Riri', 'Husky', 'Like a wolf!', 'uploads/IMG-661e3140162d22.78553741.jpg'),
(21, 'Pido', 'Aspin', 'Favorite ka Taga-West! (PS: Image may not reflect the the actual person or animal.)', 'uploads/IMG-661e4132eb1400.79743027.png'),
(29, 'Merry ', 'Puppy', '- ', 'uploads/IMG-662a3a865ecca9.88868313.jpg'),
(32, 'Rarity ', 'Cat', 'butterfly ', 'uploads/IMG-662a659178b906.04545332.jpg');

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
(2, 'Pinky', 'Bkkahhhhhhhh', ''),
(3, 'yeah', 'girls are all just the same \\r\\n - Charlie', '');

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `reactionID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `petID` int(11) NOT NULL,
  `reacted_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `liked` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reactions`
--

INSERT INTO `reactions` (`reactionID`, `userID`, `petID`, `reacted_at`, `liked`) VALUES
(1, 1, 32, '2024-05-07 17:14:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_animal_submissions`
--

CREATE TABLE `temp_animal_submissions` (
  `petID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temp_animal_submissions`
--

INSERT INTO `temp_animal_submissions` (`petID`, `name`, `breed`, `description`, `image_url`) VALUES
(36, 'Serena', 'Cat', 'Black', 'IMG-662a6790325a15.03671601.jpg'),
(37, 'Pinch', 'Dog', 'Brown and White', 'IMG-662a67a70049f2.46991979.jpg'),
(40, 'Krishnah', 'Aspin', 'Masabad kag magahod.', 'IMG-66389edff092e5.15200780.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `temp_user_account`
--

CREATE TABLE `temp_user_account` (
  `userID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image_prof` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, 'ilavkat06', 'Pika', 'Chu', 'katsu234@gmail.com', 'meh4h', 'Fluttershy.jpg'),
(14, 'iamselena', 'Selena ', 'Gomez ', 'selena@yahoo.com ', 'jfo35 ', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaccount`
--
ALTER TABLE `adminaccount`
  ADD PRIMARY KEY (`adminID`);

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
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`reactionID`),
  ADD KEY `fk_user` (`userID`),
  ADD KEY `fk_newstray` (`petID`);

--
-- Indexes for table `temp_animal_submissions`
--
ALTER TABLE `temp_animal_submissions`
  ADD PRIMARY KEY (`petID`);

--
-- Indexes for table `temp_user_account`
--
ALTER TABLE `temp_user_account`
  ADD PRIMARY KEY (`userID`);

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
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `animalprofiles`
--
ALTER TABLE `animalprofiles`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `forum_subject`
--
ALTER TABLE `forum_subject`
  MODIFY `content_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `reactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `temp_animal_submissions`
--
ALTER TABLE `temp_animal_submissions`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `temp_user_account`
--
ALTER TABLE `temp_user_account`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reactions`
--
ALTER TABLE `reactions`
  ADD CONSTRAINT `fk_newstray` FOREIGN KEY (`petID`) REFERENCES `animalprofiles` (`petID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
