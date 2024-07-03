-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 08, 2011 at 03:31 PM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(50) NOT NULL AUTO_INCREMENT,
  `first` varchar(25) NOT NULL,
  `last` varchar(25) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `first`, `last`, `street`, `city`, `state`, `zip`, `email`, `password`) VALUES
(20, 'sdsdf', 'sdfssdf', 'sdf', 'sdf', 'sdf', 'sdf', 'sdf', 'd9729feb74992cc3482b35016'),
(27, 'asda', 'asd', 'asd', 'asd', 'asd', 'asd', 'asd', '7815696ecbf1c96e6894b7794'),
(28, 'Test', 'Name', '', '', '', '', 'test@test.com', 'd41d8cd98f00b204e9800998e');
