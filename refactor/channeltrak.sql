-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2013 at 07:26 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `channeltrak`
--

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `channel_id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_slug` varchar(100) NOT NULL,
  `channel_name` text NOT NULL,
  `channel_yt_id` varchar(100) NOT NULL,
  `channel_yt_url` varchar(200) NOT NULL,
  `channel_fb_url` varchar(200) NOT NULL,
  `channel_tw_url` varchar(200) NOT NULL,
  `channel_web_url` varchar(200) NOT NULL,
  `channel_status` int(11) NOT NULL DEFAULT '0',
  `channel_approved` datetime NOT NULL,
  PRIMARY KEY (`channel_id`),
  UNIQUE KEY `channel_yt_id` (`channel_yt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `favorite_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `song_id` int(11) NOT NULL,
  PRIMARY KEY (`favorite_id`),
  UNIQUE KEY `favorite_id` (`favorite_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE IF NOT EXISTS `songs` (
  `song_id` int(11) NOT NULL AUTO_INCREMENT,
  `song_slug` varchar(100) NOT NULL,
  `song_title` text NOT NULL,
  `song_yt_id` varchar(11) NOT NULL,
  `song_channel_name` text NOT NULL,
  `song_channel_slug` varchar(100) NOT NULL,
  `song_favorites` int(11) NOT NULL DEFAULT '0',
  `song_uploaded` datetime NOT NULL,
  `song_imported` datetime NOT NULL,
  PRIMARY KEY (`song_id`),
  UNIQUE KEY `song_yt_id` (`song_yt_id`),
  KEY `song_id` (`song_id`),
  KEY `song_channel_slug` (`song_channel_slug`),
  KEY `song_slug` (`song_slug`),
  KEY `song_uploaded` (`song_uploaded`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(64) NOT NULL,
  `user_registered` datetime NOT NULL,
  `user_permissions` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
