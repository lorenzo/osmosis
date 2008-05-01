-- phpMyAdmin SQL Dump
-- version 2.11.6-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2008 at 07:08 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osmosis`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_discussions`
--

CREATE TABLE IF NOT EXISTS `forum_discussions` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `topic_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `sticky` tinyint(1) NOT NULL,
  `status` varchar(20) collate utf8_unicode_ci NOT NULL default 'unlocked' COMMENT 'Describes activity inside subject',
  `response_count` int(11) NOT NULL,
  `discussion_visit_count` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_forums`
--

CREATE TABLE IF NOT EXISTS `forum_forums` (
  `id` int(11) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_responses`
--

CREATE TABLE IF NOT EXISTS `forum_responses` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `discussion_id` char(36) collate utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(120) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Name of the subject',
  `description` varchar(255) NOT NULL COMMENT 'Description of the forum''s subject',
  `forum_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `status` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL default 'unlocked' COMMENT 'Describes activity inside topic',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
