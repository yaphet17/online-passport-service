-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2021 at 12:28 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ops`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `applicantId` int(11) NOT NULL,
  `region` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `woreda` varchar(50) NOT NULL,
  `kebele` varchar(50) NOT NULL,
  `houseNum` varchar(50) NOT NULL,
  `poBox` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`applicantId`, `region`, `city`, `state`, `woreda`, `kebele`, `houseNum`, `poBox`) VALUES
(1, 'Addis Ababa', 'Addis Ababa', 'Addis Ababa', '07', '21', 'aa11', '18888'),
(2, 'Addis Ababa', 'Addis Ababa', 'Addis Ababa', '07', '21', 'aa11', '18888');

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `username` varchar(25) NOT NULL,
  `password` varchar(256) NOT NULL,
  `adminLevel` int(1) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`username`, `password`, `adminLevel`, `email`) VALUES
('yafet123', '$2y$10$DKIRtUd/YZ4e8yTUTRoQr.1M8MSZ52IZdXwJXVtK5pLbFHJlz7IyO', 1, 'reciever@localhost');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `applicantId` int(11) NOT NULL,
  `requestType` varchar(25) NOT NULL,
  `pageNum` int(2) NOT NULL,
  `scheduleDate` date NOT NULL,
  `scheduleTime` int(1) NOT NULL,
  `applicationNum` varchar(61) NOT NULL,
  `confirmationNum` char(7) NOT NULL,
  `paymentCode` varchar(9) NOT NULL,
  `applicationDate` datetime NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`applicantId`, `requestType`, `pageNum`, `scheduleDate`, `scheduleTime`, `applicationNum`, `confirmationNum`, `paymentCode`, `applicationDate`, `status`) VALUES
(1, 'New', 32, '2021-05-23', 1, 'YafetBerhanu23', 'be6a015', 'Ya2305929', '2021-05-23 11:56:59', 1),
(2, 'New', 32, '2021-05-23', 5, 'WissomJemal23', '982b818', 'Wi2305915', '2021-05-23 12:54:11', -1);

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE `attachment` (
  `applicantId` int(11) NOT NULL,
  `idDoc` varchar(500) NOT NULL,
  `birthCertDoc` varchar(500) NOT NULL,
  `courtLettDoc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`applicantId`, `idDoc`, `birthCertDoc`, `courtLettDoc`) VALUES
(1, 'Document/Id-Document/60aa26eb4e2d50.46800142.pdf', 'Document/Birth-Certificate-Document/60aa26eb557b04.06900149.pdf', 'path'),
(2, 'Document/Id-Document/60aa345349e0b1.70464849.pdf', 'Document/Birth-Certificate-Document/60aa3453507d11.54319143.pdf', 'path');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `applicantId` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`applicantId`, `date`, `time`, `status`) VALUES
(1, '2021-05-23', '11:56:59', 'read'),
(2, '2021-05-23', '12:54:11', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `personaldetail`
--

CREATE TABLE `personaldetail` (
  `applicationId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `fatherName` varchar(50) NOT NULL,
  `grandfatherName` varchar(50) NOT NULL,
  `amharicFname` varchar(255) NOT NULL,
  `amharicFfname` varchar(255) NOT NULL,
  `amharicGfname` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `phoneNum` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `birthPlace` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `hairColor` varchar(25) NOT NULL,
  `eyeColor` varchar(25) NOT NULL,
  `height` int(3) NOT NULL,
  `martialStatus` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `personaldetail`
--

INSERT INTO `personaldetail` (`applicationId`, `firstName`, `fatherName`, `grandfatherName`, `amharicFname`, `amharicFfname`, `amharicGfname`, `birthDate`, `nationality`, `phoneNum`, `email`, `birthPlace`, `occupation`, `gender`, `hairColor`, `eyeColor`, `height`, `martialStatus`) VALUES
(1, 'Yafet', 'Berhanu', 'Garno', 'ያፌት', 'ብርሀኑ', 'ጋርኖ', '2000-02-25', 'Ethiopia', '0911156102', 'reciever@localhost', 'Addis Ababa', 'Student', 'M', 'Black', 'Black', 172, 'Single'),
(2, 'Wissom', 'Jemal', 'Mahamud', 'Wissom', 'Jemal', 'Mahamud', '2021-05-25', 'Ethiopia', '1111111111', 'reciever@localhost', 'Addis Ababa', 'Student', 'M', 'Black', 'Black', 175, 'Single');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `applicantId` int(11) NOT NULL,
  `siteSelection` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `office` varchar(100) NOT NULL,
  `deliverySite` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`applicantId`, `siteSelection`, `city`, `office`, `deliverySite`) VALUES
(1, 'Addis Ababa', 'Addis Ababa', 'Addis Ababa INVEA', 'Addis Ababa Post Office'),
(2, 'Addis Ababa', 'Addis Ababa', 'Addis Ababa INVEA', 'Addis Ababa Post Office');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD KEY `appId` (`applicantId`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD KEY `appId` (`applicantId`);

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD KEY `appId` (`applicantId`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD KEY `appId` (`applicantId`);

--
-- Indexes for table `personaldetail`
--
ALTER TABLE `personaldetail`
  ADD PRIMARY KEY (`applicationId`),
  ADD UNIQUE KEY `applicationId` (`applicationId`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD KEY `appId` (`applicantId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `personaldetail`
--
ALTER TABLE `personaldetail`
  MODIFY `applicationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `personaldetail` (`applicationId`) ON DELETE CASCADE;

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `personaldetail` (`applicationId`) ON DELETE CASCADE;

--
-- Constraints for table `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `personaldetail` (`applicationId`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `personaldetail` (`applicationId`);

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_1` FOREIGN KEY (`applicantId`) REFERENCES `personaldetail` (`applicationId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
