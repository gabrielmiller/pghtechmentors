-- phpMyAdmin SQL Dump
-- version 4.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2013 at 06:43 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pghtechmentors`
--
CREATE DATABASE IF NOT EXISTS `pghtechmentors` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pghtechmentors`;

-- --------------------------------------------------------

--
-- Table structure for table `day`
--

CREATE TABLE IF NOT EXISTS `day` (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_name` varchar(30) NOT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `day`
--

INSERT INTO `day` (`day_id`, `day_name`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE IF NOT EXISTS `timeslot` (
  `timeslot_id` int(11) NOT NULL AUTO_INCREMENT,
  `timeslot_name` varchar(30) NOT NULL,
  PRIMARY KEY (`timeslot_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeslot_id`, `timeslot_name`) VALUES
(1, 'Morning (before 12 PM)'),
(2, 'Afternoon (12 PM - 5 PM)'),
(3, 'Evening (After 5PM)');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_type` char(1) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `name_last` varchar(255) NOT NULL,
  `name_first` varchar(255) NOT NULL,
  `contact_home` varchar(30) DEFAULT NULL,
  `contact_mobile` varchar(30) DEFAULT NULL,
  `skill` varchar(255) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '0',
  `zip_code` varchar(10) NOT NULL,
  `about_me` text NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `account_type`, `email_id`, `name_last`, `name_first`, `contact_home`, `contact_mobile`, `skill`, `is_available`, `zip_code`, `about_me`, `passwd`, `salt`) VALUES
(1, 'M', 'mentor@gmail.com', 'Mentor ', 'Bob', NULL, '12132432', 'Web Development', 1, '15217', 'I have 11 yrs of experience in the Web site development. I love to teach kids. My prev. exp is so and so. ', '12345', ''),
(2, 'F', 'facilitator@pitt.com', 'Bathney house', '', '32323', NULL, '', 1, '15225', 'We are Bathney House', '', ''),
(3, 'M', 'gabe@miller.com', 'Miller', 'Gabe', '123445689', '123', 'Web Development', 1, '11111', 'Hi!!!!', 'e9cff9796f470b0272406a68ade7086b45e66152', '3b139da640');

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE IF NOT EXISTS `user_privilege` (
  `user_id` int(11) DEFAULT NULL,
  `access_permission` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_timeslot`
--

CREATE TABLE IF NOT EXISTS `user_timeslot` (
  `user_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL,
  `timeslot_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_timeslot`
--

INSERT INTO `user_timeslot` (`user_id`, `day_id`, `timeslot_id`) VALUES
(1, 1, 1),
(1, 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
