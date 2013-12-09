-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: sql4.freesqldatabase.com
-- Generation Time: Dec 09, 2013 at 07:22 AM
-- Server version: 5.5.34-0ubuntu0.12.04.1
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sql424404`
--

-- --------------------------------------------------------

--
-- Table structure for table `intelmlm_active_guests`
--

CREATE TABLE IF NOT EXISTS `intelmlm_active_guests` (
  `ip` varchar(15) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intelmlm_active_users`
--

CREATE TABLE IF NOT EXISTS `intelmlm_active_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intelmlm_active_users`
--

INSERT INTO `intelmlm_active_users` (`username`, `timestamp`) VALUES
('admin', 1386573769);

-- --------------------------------------------------------

--
-- Table structure for table `intelmlm_banned_users`
--

CREATE TABLE IF NOT EXISTS `intelmlm_banned_users` (
  `username` varchar(30) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `intelmlm_mail`
--

CREATE TABLE IF NOT EXISTS `intelmlm_mail` (
  `Deleted` tinyint(1) NOT NULL DEFAULT '0',
  `UserTo` tinytext NOT NULL,
  `UserFrom` tinytext NOT NULL,
  `Subject` mediumtext NOT NULL,
  `Message` longtext NOT NULL,
  `status` text NOT NULL,
  `SentDate` text NOT NULL,
  `mail_id` int(80) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`mail_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `intelmlm_users`
--

CREATE TABLE IF NOT EXISTS `intelmlm_users` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `bpassword` varchar(100) NOT NULL,
  `userid` varchar(32) DEFAULT NULL,
  `userlevel` tinyint(1) unsigned NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  `valid` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `hash` varchar(32) NOT NULL,
  `hash_generated` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `intelmlm_users`
--

INSERT INTO `intelmlm_users` (`username`, `password`, `bpassword`, `userid`, `userlevel`, `email`, `timestamp`, `valid`, `name`, `hash`, `hash_generated`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'ed3b9bb448ac8d3a05356db7d1018579', 9, 'admin@intelmlm.com', 1386573769, 1, NULL, '1e82e9b24ab41de17a661a523f5623fa', 1386525172),
('test_guest', 'e10adc3949ba59abbe56e057f20f883e', '123456', NULL, 0, NULL, 0, 0, NULL, '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
