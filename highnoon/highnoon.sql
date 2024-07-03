-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2013 at 07:05 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `highnoon`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Belt Holsters'),
(2, 'IWB Holsters'),
(3, 'Exotic Holsters'),
(4, 'Red Nichols'),
(5, 'Belts'),
(6, 'Magazine Carriers'),
(7, 'Pocket Holsters'),
(8, 'Shoulder Rigs'),
(9, 'Paddle Holsters'),
(10, 'Misc'),
(11, 'Close Outs');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `thumbnail`) VALUES
(1, 'Skin Guard', '54.95', 'Skin-Guard-sm-180-x-249.jpg'),
(2, 'Bare Skin', '54.95', 'Bare-Skin-sm-195-x-234.jpg'),
(3, 'Skin Tite', '54.95', 'Skin-Tite-sm-180-x-234.jpg'),
(4, 'Swift Skin', '74.95', 'Swift-Skin-sm-155-x-249.jpg'),
(5, 'Yaqui Skin', '49.95', 'Yaqui-Skin-sm-180-x-234.jpg'),
(6, 'Yaqui Slide', '54.95', 'Yaqui-Slide-sm-165-x-244.jpg'),
(7, 'Back Skin', '69.95', 'Back-Skin-sm-250-x-218.jpg'),
(8, 'Slide Guard', '104.95', 'Slide-Guard-Tan-sm-180-x-234.jpg'),
(9, 'Topless', '104.95', 'Topless-Tan-sm-180-x-231.jpg'),
(10, 'Sky High', '104.95', 'Sky-High-Tan-sm-180-x-234.jpg'),
(11, 'Need For Speed', '119.95', 'Need-For-Speed-Tan-sm-150-x-238.jpg'),
(12, 'Snapper', '129.95', 'Snapper-Tan-sm-190-x-232.jpg'),
(13, 'Bottom Line', '109.95', 'Bottom-Line-280-x-243-sm.jpg'),
(14, 'Side Effect', '154.95', 'Side-Effect-Tan-sm-180-x-251.jpg'),
(15, 'Black Legion', '234.95', 'Nichol-Black-Legion-sm.jpg'),
(16, 'Maltese Falcon', '244.95', 'Nichols_Maltese_Falcon_sm.JPG'),
(17, 'Sirocco', '254.95', 'Nichols-Sirocco-sm.jpg'),
(18, 'Dead End', '234.95', 'Nichols-Dead-End-sm.jpg'),
(19, 'China Clipper', '79.95', 'Nichols-Mag-Pouch-sm.jpg'),
(20, 'Dark Victory Shoulder Holster System', '349.95', 'Dark-Victory-sm.jpg'),
(21, 'The Big Shot', '244.95', 'Nichols-Big-Shot-sm.jpg'),
(22, 'Mr. Softy Low Ride', '29.95', 'Mr-Softy-sm-180-x-235.jpg'),
(23, 'Upper Cut High Ride', '29.95', 'Upper_Cut_sm_180_x_235.jpg'),
(24, 'Bare Asset High Ride', '29.95', 'Bare-Asset-sm-180-x-248.jpg'),
(25, 'Hidden Ally Low Ride Tuckable', '39.95', 'Hidden-Ally-sm-180-x-235.jpg'),
(26, 'Centerfold High Ride Tuckable', '39.95', 'Centerfold-sm-180-x-235.jpg'),
(27, 'Split Decision High Ride Tuckable', '39.95', 'Split-Decision-sm-170-x-247.jpg'),
(28, 'Hideaway W/Clip Low Ride', '74.95', 'Hideaway-Cow-Clip-sm-180-x-235.jpg'),
(29, 'Hideaway W/Straps Low Ride', '74.95', 'Hideaway_Cow_Straps_sm_180_x235.jpg'),
(30, 'Upper Limit W/Clip', '74.95', 'Upper_Limit_Clip_sm_200_x_239.jpg'),
(31, 'Upper Limit W/Straps High Ride', '74.95', 'Upper_Limit_Straps_sm.jpg'),
(32, 'Bare Necessity W/Clip High Ride', '74.95', 'Bare_Necessity_Clip_sm_190_x_254.jpg'),
(33, 'Bare Necessity W/Straps High Ride', '74.95', 'Bare_Necessity_Straps_sm.jpg'),
(34, 'Hidden Impact Low Ride Tuckable', '79.95', 'Hidden-Impact-sm-190-x-260.jpg'),
(35, 'Center Piece High Ride Tuckable', '79.95', 'Center-Piece-sm-190-x241.jpg'),
(36, 'Split Level High Ride Tuckable', '79.95', 'Split-Level-sm-190-x-261.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE IF NOT EXISTS `products_categories` (
  `category_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`category_id`, `item_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 25),
(2, 26),
(2, 27),
(2, 28),
(2, 29),
(2, 30),
(2, 31),
(2, 32),
(2, 33),
(2, 34),
(2, 35),
(2, 36),
(2, 36);

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE IF NOT EXISTS `temp_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `password`) VALUES
(1, 'Nick', 'nwbair@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(4, 'tek', 'supertekguy@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
