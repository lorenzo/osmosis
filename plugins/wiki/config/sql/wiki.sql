-- phpMyAdmin SQL Dump
-- version 2.11.4-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2008 at 03:43 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `osmosis`
--

-- --------------------------------------------------------

--
-- Table structure for table `wiki_entries`
--

CREATE TABLE IF NOT EXISTS `wiki_entries` (
  `id` int(11) NOT NULL auto_increment,
  `wiki_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `revision` int(6) NOT NULL default '1',
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `slug` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wiki_revisions`
--

CREATE TABLE IF NOT EXISTS `wiki_revisions` (
  `id` int(11) NOT NULL auto_increment,
  `entry_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `content` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `revision` int(6) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wiki_wikis`
--

CREATE TABLE IF NOT EXISTS `wiki_wikis` (
  `id` int(10) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;
