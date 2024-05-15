-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2024 at 01:02 PM
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
(16, 'Yamyam', 'Puspin', 'Confident and charming, Yamyam struts through campus with style, captivating everyone he meets with his personality.', '../uploads/pet6.png'),
(17, 'Katy', 'Puspin', 'Despite her mean appearance, Katy is a friendly cat with a heart of gold.', '../uploads/pet8.png'),
(18, 'Tricia', 'Puspin', 'A silent observer of the night, Tricia\'s mysterious nature hides a playful streak beneath her light fur.', '../uploads/pet9.png'),
(19, 'Pocholo', 'Aspin', 'With a sunny vibe and a love for playtime, Pocholo is an popular for the Taga-West community.', '../uploads/pet1.png'),
(21, 'Mama', 'Aspin', 'With her soulful eyes and gentle demeanor, Mama is a calming presence in the gardens of General Services Office.', '../uploads/pet2.png'),
(32, 'Butchog', 'Cat', 'With boundless energy and a love for adventure, Butchog brings joy wherever he goes with his colorful personality.', '../uploads/pet5.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animalprofiles`
--
ALTER TABLE `animalprofiles`
  ADD PRIMARY KEY (`petID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animalprofiles`
--
ALTER TABLE `animalprofiles`
  MODIFY `petID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
