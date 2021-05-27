-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 29 Σεπ 2014 στις 08:16:12
-- Έκδοση διακομιστή: 5.6.16
-- Έκδοση PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση δεδομένων: `getitfixed`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `gadmins`
--

CREATE TABLE IF NOT EXISTS `gadmins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_email` varchar(32) NOT NULL,
  `admin_username` varchar(32) NOT NULL,
  `admin_pass` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_username` (`admin_username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Άδειασμα δεδομένων του πίνακα `gadmins`
--

INSERT INTO `gadmins` (`admin_id`, `admin_email`, `admin_username`, `admin_pass`) VALUES
(1, 'admin@admin.gr', 'Admin', 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `gcategories`
--

CREATE TABLE IF NOT EXISTS `gcategories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(32) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `greports`
--

CREATE TABLE IF NOT EXISTS `greports` (
  `rep_id` int(11) NOT NULL AUTO_INCREMENT,
  `rep_cat` int(11) NOT NULL,
  `rep_userid` int(11) NOT NULL,
  `rep_adminname` varchar(20) DEFAULT NULL,
  `rep_comment` text,
  `rep_file_1` varchar(50) DEFAULT NULL,
  `rep_file_2` varchar(50) DEFAULT NULL,
  `rep_file_3` varchar(50) DEFAULT NULL,
  `rep_file_4` varchar(50) DEFAULT NULL,
  `rep_lat` float(10,6) NOT NULL,
  `rep_lng` float(10,6) NOT NULL,
  `rep_name` text NOT NULL,
  `rep_stat` varchar(10) NOT NULL DEFAULT 'none',
  `rep_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rep_date_fixed` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=200 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `gusers`
--

CREATE TABLE IF NOT EXISTS `gusers` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_pass` int(20) NOT NULL,
  `user_fname` varchar(32) NOT NULL,
  `user_lname` varchar(32) NOT NULL,
  `user_phone` int(10) DEFAULT NULL,
  `user_email` varchar(32) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=262 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
