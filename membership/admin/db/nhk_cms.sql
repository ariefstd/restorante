-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 04, 2012 at 10:23 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nhk_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `member_card_no` tinyint(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `ic_passport` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `mobile_no_1` varchar(20) NOT NULL,
  `mobile_no_2` varchar(20) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mailing_add` text NOT NULL,
  `card_collection` varchar(20) NOT NULL,
  `date_join` int(12) NOT NULL,
  `expiry_date` int(12) NOT NULL,
  `status` varchar(10) NOT NULL,
  `is_deleted` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10001 ;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `member_card_no`, `username`, `password`, `full_name`, `ic_passport`, `gender`, `email`, `contact_no`, `mobile_no_1`, `mobile_no_2`, `nationality`, `occupation`, `address`, `mailing_add`, `card_collection`, `date_join`, `expiry_date`, `status`, `is_deleted`) VALUES
(10000, 0, 'admin', 'admin123', 'john doe', '821111111111', 'female', 'doe@mail.com', '12345678', '12345678', '12345678', 'malaysian', 'unemployed', '<p>testing street</p>\r\n<p>&nbsp;</p>', '<p>testing street</p>\r\n<p>&nbsp;</p>', 'self_collection', 1349338020, 1412438400, 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` int(12) NOT NULL,
  `last_login` int(12) NOT NULL,
  `permission` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `active`, `date_created`, `last_login`, `permission`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 'johndoe@mail.com', 1, 1342091744, 1349337626, 0);
