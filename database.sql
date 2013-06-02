-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 02, 2013 at 02:08 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pghtechmentors`
--

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
(1, 'Sunday'),
(2, 'Monday'),
(3, 'Tuesday'),
(4, 'Wednesday'),
(5, 'Thursday'),
(6, 'Friday'),
(7, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `locationid` int(11) NOT NULL,
  `locationname` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_location`
--

CREATE TABLE IF NOT EXISTS `user_location` (
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `user_skill`
--

CREATE TABLE IF NOT EXISTS `user_skill` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
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
