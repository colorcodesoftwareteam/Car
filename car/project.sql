-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2014 at 11:54 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `car_year` varchar(4) DEFAULT NULL,
  `body_number` varchar(45) DEFAULT NULL,
  `cylinder` varchar(4) DEFAULT NULL,
  `fuel_tank` varchar(2) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `brand_id`, `model_id`, `car_year`, `body_number`, `cylinder`, `fuel_tank`, `color`, `detail`) VALUES
(2, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL),
(4, 2, 2, '2010', '1ssdww', '1.5', '20', NULL, NULL),
(5, 2, 2, '2010', '1ssdww', '1.5', '20', NULL, NULL),
(7, 2, 2, '2010', '1ssdww', '1.5', '20', NULL, NULL),
(10, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL),
(11, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL),
(12, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL),
(20, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL),
(22, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL),
(23, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL),
(24, 2, 2, '2014', 'ssx255-5646', '1.9', '25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carbrand`
--

CREATE TABLE IF NOT EXISTS `carbrand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `carbrand`
--

INSERT INTO `carbrand` (`id`, `name`) VALUES
(2, 'toyota'),
(3, 'honda'),
(4, 'susuki'),
(6, 'subaru');

-- --------------------------------------------------------

--
-- Table structure for table `carimages`
--

CREATE TABLE IF NOT EXISTS `carimages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Car_id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CarImages_FKIndex1` (`Car_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `carmodel`
--

CREATE TABLE IF NOT EXISTS `carmodel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `brand_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`),
  KEY `brand_id_2` (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `carmodel`
--

INSERT INTO `carmodel` (`id`, `name`, `brand_id`) VALUES
(1, 'altis', 3),
(2, 'cammy', 2),
(3, 'accord', 3),
(10, 'TZR', 6),
(11, 'xxxx', 6);

-- --------------------------------------------------------

--
-- Table structure for table `mapping_carbrand_carmodel`
--

CREATE TABLE IF NOT EXISTS `mapping_carbrand_carmodel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CarBrand_id` int(10) unsigned NOT NULL,
  `CarModel_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Mapping_CarBrand_CarModel_FKIndex1` (`CarModel_id`),
  KEY `Mapping_CarBrand_CarModel_FKIndex2` (`CarBrand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Role_id` int(10) unsigned NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `gender` bit(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Member_FKIndex1` (`Role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
