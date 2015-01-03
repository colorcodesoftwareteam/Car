-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2015 at 10:00 AM
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
-- Table structure for table `brand_model_mapping`
--

CREATE TABLE IF NOT EXISTS `brand_model_mapping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) unsigned NOT NULL,
  `model_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`brand_id`,`model_id`),
  KEY `fk_brand_model_mapping_carbrand1_idx` (`brand_id`),
  KEY `fk_brand_model_mapping_carmodel1_idx` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `brand_model_mapping`
--

INSERT INTO `brand_model_mapping` (`id`, `brand_id`, `model_id`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 10),
(5, 3, 11),
(6, 3, 12),
(7, 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `car_year` varchar(4) DEFAULT NULL,
  `body_number` varchar(45) DEFAULT NULL,
  `cylinder` varchar(4) DEFAULT NULL,
  `fuel_tank` varchar(2) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `register_year` varchar(4) DEFAULT NULL,
  `distance` varchar(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `gear` varchar(255) DEFAULT NULL,
  `province` varchar(45) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `telepone` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `create_dt` datetime DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  `member_id` int(10) unsigned NOT NULL,
  `brand_model_mapping_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`member_id`,`brand_model_mapping_id`),
  KEY `fk_car_member1_idx` (`member_id`),
  KEY `fk_car_brand_model_mapping1_idx` (`brand_model_mapping_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `car_year`, `body_number`, `cylinder`, `fuel_tank`, `color`, `detail`, `price`, `register_year`, `distance`, `status`, `gear`, `province`, `address`, `telepone`, `email`, `create_dt`, `update_dt`, `member_id`, `brand_model_mapping_id`) VALUES
(2, '2014', 'CAMRY-00001', '2.6', '55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-12-20 03:58:40', 1, 1),
(4, '2013', 'CAMRY-00002', '2.0', '55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 1, 1),
(6, '2014', 'ALTIS-00001', '1.8', '55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 1, 2),
(7, '2014', 'ALTIS-00002', '1.6', '55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 1, 2),
(8, '2014', 'VIOS-00001', '1.5', '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 1, 3),
(9, '2013', 'ACCORD-00001', '2.4', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 7, 4),
(10, '2014', 'ACCORD-00002', '2.0', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 7, 4),
(11, '2014', 'CIVIC-00001', '2.0', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 7, 5),
(12, '2014', 'CIVIC-00002', '1.8', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 7, 5),
(13, '2013', 'CITY-00001', '1.6', '45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-11-25 17:23:54', '2014-11-25 17:23:54', 7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `carbrand`
--

CREATE TABLE IF NOT EXISTS `carbrand` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `carbrand`
--

INSERT INTO `carbrand` (`id`, `name`) VALUES
(2, 'TOYOTA'),
(3, 'HONDA'),
(4, 'ISUZU');

-- --------------------------------------------------------

--
-- Table structure for table `carimages`
--

CREATE TABLE IF NOT EXISTS `carimages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `create_dt` datetime DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`car_id`),
  KEY `fk_carimages_car_idx` (`car_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `carimages`
--

INSERT INTO `carimages` (`id`, `name`, `path`, `detail`, `create_dt`, `car_id`) VALUES
(1, 'Toyota_Camry_2_4', 'img/upload/Toyota_Camry_2_4.jpg', NULL, '2014-11-25 17:23:54', 0),
(2, 'Toyota_Camry_2_4', 'img/upload/Toyota_Camry_2_4_2.jpg', NULL, '2014-11-25 17:23:54', 0),
(3, 'Toyota_Camry_2_4', 'img/upload/Toyota_Camry_2_4_3.jpg', NULL, '2014-11-25 17:23:54', 0),
(4, 'Toyota_Camry_2_0', 'img/upload/Toyota_Camry_2_0.jpg', NULL, '2014-11-25 17:23:54', 4),
(5, 'Toyota_Altis_1.8', 'img/upload/Toyota_Altis_1.8.jpg', NULL, '2014-11-25 17:23:54', 6),
(6, 'Toyota_Altis_1.8', 'img/upload/Toyota_Altis_1.8_2.jpg', NULL, '2014-11-25 17:23:54', 6),
(7, 'Toyota_Altis_1.6', 'img/upload/Toyota_Altis_1_6.jpg', NULL, '2014-11-25 17:23:54', 7),
(8, 'Toyota_Vios_1_6', 'img/upload/Toyota_Vios_1_6.jpg', NULL, '2014-11-25 17:23:54', 8),
(9, 'Toyota_Vios_1_6', 'img/upload/Toyota_Vios_1_6_2.jpg', NULL, '2014-11-25 17:23:54', 8),
(10, 'Honda_Accord_2_4', 'img/upload/Honda_Accord_2_4.jpg', NULL, '2014-11-25 17:23:54', 9),
(11, 'Honda_Accord_2_4', 'img/upload/Honda_Accord_2_4_2.jpg', NULL, '2014-11-25 17:23:54', 9),
(12, 'Honda_Accord_2_0', 'img/upload/Honda_Accord_2_0.jpg', NULL, '2014-11-25 17:23:54', 10),
(13, 'Honda_Civic_2_0', 'img/upload/Honda_Civic_2_0.jpg', NULL, '2014-11-25 17:23:54', 11),
(14, 'Honda_Civic_1_8', 'img/upload/Honda_Civic_1_8.jpg', NULL, '2014-11-25 17:23:54', 12),
(15, 'Honda_Civic_1_8', 'img/upload/Honda_Civic_1_8_2.jpg', NULL, '2014-11-25 17:23:54', 12),
(16, 'Honda_Civic_1_8', 'img/upload/Honda_Civic_1_8_3.jpg', NULL, '2014-11-25 17:23:54', 12),
(17, 'Honda_City_1_5', 'img/upload/Honda_City_1_5.jpg', NULL, '2014-11-25 17:23:54', 13),
(18, 'Honda_City_1_5', 'img/upload/Honda_City_1_5_2.jpg', NULL, '2014-11-25 17:23:54', 13);

-- --------------------------------------------------------

--
-- Table structure for table `carmodel`
--

CREATE TABLE IF NOT EXISTS `carmodel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `carmodel`
--

INSERT INTO `carmodel` (`id`, `name`) VALUES
(1, 'CAMRY'),
(2, 'ALTIS'),
(3, 'VIOS'),
(10, 'ACCORD'),
(11, 'CIVIC'),
(12, 'CITY'),
(13, 'D-MAX');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `gender` bit(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `create_dt` datetime DEFAULT NULL,
  `update_dt` datetime DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`role_id`),
  KEY `fk_member_role1_idx` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `name`, `lastname`, `gender`, `birthdate`, `address`, `phoneNumber`, `email`, `password`, `detail`, `create_dt`, `update_dt`, `role_id`) VALUES
(1, 'Administrator', 'Administrator', '1', '2014-05-05', '', 'admin', 'admin@mail.com', '', NULL, '2014-12-20 04:49:56', '2014-12-20 04:49:56', 0),
(7, 'Member', 'Member', '1', '2014-05-05', '', 'Member', 'member@mail.com', '', NULL, '2014-12-20 04:49:56', '2014-12-20 04:49:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `detail` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `detail`) VALUES
(1, 'ผู้ดูแลระบบ', ''),
(2, 'สมาชิก', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand_model_mapping`
--
ALTER TABLE `brand_model_mapping`
  ADD CONSTRAINT `fk_bran_model_mapping_carbrand1` FOREIGN KEY (`brand_id`) REFERENCES `carbrand` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bran_model_mapping_carmodel1` FOREIGN KEY (`model_id`) REFERENCES `carmodel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `fk_car_brand_model_mapping1` FOREIGN KEY (`brand_model_mapping_id`) REFERENCES `brand_model_mapping` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_car_member1` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `carimages`
--
ALTER TABLE `carimages`
  ADD CONSTRAINT `fk_carimages_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_member_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
