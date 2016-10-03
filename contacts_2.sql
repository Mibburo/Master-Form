-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2016 at 03:30 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contacts_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactaddresses`
--

CREATE TABLE `contactaddresses` (
  `AddrId` int(11) NOT NULL,
  `ContactId` int(11) NOT NULL,
  `Prefecture` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `ConInfoType` varchar(255) NOT NULL,
  `LocationType` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `ZipCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactdetails`
--

CREATE TABLE `contactdetails` (
  `EphoId` int(11) NOT NULL,
  `ContactId` int(11) NOT NULL,
  `ConInfoType` varchar(255) NOT NULL,
  `LocationType` varchar(255) NOT NULL,
  `Details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactdetailstype`
--

CREATE TABLE `contactdetailstype` (
  `ConInfoType` varchar(255) NOT NULL,
  `LocationType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactdetailstype`
--

INSERT INTO `contactdetailstype` (`ConInfoType`, `LocationType`) VALUES
('Address', 'Home'),
('Address', 'Work'),
('Email', 'Home'),
('Email', 'Work'),
('Phone', 'Home'),
('Phone', 'Mobile'),
('Phone', 'Work');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `ID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `FatherName` varchar(255) NOT NULL,
  `SSN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prefecturescities`
--

CREATE TABLE `prefecturescities` (
  `PrefectureName` varchar(255) NOT NULL,
  `CityName` varchar(255) NOT NULL,
  `AreaCode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prefecturescities`
--

INSERT INTO `prefecturescities` (`PrefectureName`, `CityName`, `AreaCode`) VALUES
('Attikis', 'Athens', '210'),
('Attikis', 'Laurio', '22920'),
('Attikis', 'Marathonas', '22940'),
('Kykladon', 'Andros', '22820'),
('Kykladon', 'Naxos', '22850'),
('kykladon', 'Santorini', '22860'),
('Thessalonikis', 'Kalamaria', '2313'),
('Thessalonikis', 'Panorama', '2313'),
('Thessalonikis', 'Thessaloniki', '2310');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactaddresses`
--
ALTER TABLE `contactaddresses`
  ADD PRIMARY KEY (`AddrId`,`ContactId`,`Prefecture`,`ConInfoType`),
  ADD KEY `ContactId` (`ContactId`),
  ADD KEY `ConInfoType` (`ConInfoType`),
  ADD KEY `Prefecture` (`Prefecture`);

--
-- Indexes for table `contactdetails`
--
ALTER TABLE `contactdetails`
  ADD PRIMARY KEY (`EphoId`,`ContactId`,`ConInfoType`),
  ADD KEY `ContactId` (`ContactId`),
  ADD KEY `ConInfoType` (`ConInfoType`);

--
-- Indexes for table `contactdetailstype`
--
ALTER TABLE `contactdetailstype`
  ADD PRIMARY KEY (`ConInfoType`,`LocationType`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `prefecturescities`
--
ALTER TABLE `prefecturescities`
  ADD PRIMARY KEY (`PrefectureName`,`CityName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactaddresses`
--
ALTER TABLE `contactaddresses`
  MODIFY `AddrId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `contactdetails`
--
ALTER TABLE `contactdetails`
  MODIFY `EphoId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contactaddresses`
--
ALTER TABLE `contactaddresses`
  ADD CONSTRAINT `contactaddresses_ibfk_1` FOREIGN KEY (`ContactId`) REFERENCES `contacts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactaddresses_ibfk_2` FOREIGN KEY (`ConInfoType`) REFERENCES `contactdetailstype` (`ConInfoType`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactaddresses_ibfk_3` FOREIGN KEY (`Prefecture`) REFERENCES `prefecturescities` (`PrefectureName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contactdetails`
--
ALTER TABLE `contactdetails`
  ADD CONSTRAINT `contactdetails_ibfk_1` FOREIGN KEY (`ContactId`) REFERENCES `contacts` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contactdetails_ibfk_2` FOREIGN KEY (`ConInfoType`) REFERENCES `contactdetailstype` (`ConInfoType`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
