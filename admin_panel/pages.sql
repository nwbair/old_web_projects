-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2011 at 01:31 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `almostlabs`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `created` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`ID`, `title`, `page`, `created`) VALUES
(1, '', '', '0000-00-00'),
(2, '', '', '0000-00-00'),
(3, '', '', '0000-00-00'),
(4, '', '', ''),
(5, 'asda', '', 'asda'),
(6, '', '', ''),
(7, 'Test Page', '', '3-4-11'),
(8, 'qweq', 'qweqweq', 'qweqw'),
(9, 'qweq', '', 'wewe'),
(10, 'Test 123', '', '8-7-11'),
(11, 'Privacy', '', '08-11-2011');
