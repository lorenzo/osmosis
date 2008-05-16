-- phpMyAdmin SQL Dump
-- version 2.11.4-rc1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2008 at 03:38 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `osmosis`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default '',
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default '',
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default '',
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default '',
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(11) NOT NULL auto_increment,
  `aro_id` int(11) default NULL,
  `aco_id` int(11) default NULL,
  `_create` int(11) NOT NULL default '0',
  `_read` int(11) NOT NULL default '0',
  `_update` int(11) NOT NULL default '0',
  `_delete` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `department_id` int(4) unsigned NOT NULL,
  `code` varchar(10) collate utf8_unicode_ci NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `institution_id` varchar(20) collate utf8_unicode_ci default NULL,
  `full_name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `email` varchar(50) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(20) collate utf8_unicode_ci default NULL,
  `country` varchar(20) collate utf8_unicode_ci NOT NULL,
  `city` varchar(50) collate utf8_unicode_ci NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(1) collate utf8_unicode_ci NOT NULL default 'M',
  `role_id` int(11) unsigned NOT NULL,
  `username` varchar(15) collate utf8_unicode_ci NOT NULL,
  `password` varchar(50) collate utf8_unicode_ci NOT NULL,
  `last_seen` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents a registered user';

-- --------------------------------------------------------

--
-- Table structure for table `model_logs`
--

CREATE TABLE IF NOT EXISTS `model_logs` (
  `id` int(11) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `model` varchar(50) character set latin1 NOT NULL,
  `entity_id` varchar(36) character set latin1 NOT NULL,
  `created` tinyint(1) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `course_tools`
-- 

CREATE TABLE IF NOT EXISTS `course_tools` (
  `id` int(10) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  `plugin_id` smallint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `course_id` (`course_id`,`plugin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Represents the tools that a course has installed' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `plugins`
-- 

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` smallint(4) unsigned NOT NULL auto_increment,
  `title` varchar(50) collate utf8_unicode_ci default NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` varchar(255) collate utf8_unicode_ci default NULL,
  `author` varchar(100) collate utf8_unicode_ci default NULL,
  `types` varchar(30) collate utf8_unicode_ci NOT NULL default 'tool',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds installed plugin names and active status';


-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `role` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents groups of users with permissions';


-- --------------------------------------------------------

--
-- Table structure for table `courses_members`
--

CREATE TABLE IF NOT EXISTS `courses_members` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `role` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `member_id` (`member_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `online_users`
--

CREATE TABLE IF NOT EXISTS `online_users` (
  `member_id` int(11) NOT NULL,
  `modified` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `viewing` varchar(255) NOT NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Represent the online users and what are they doing on the sy';

-- 
-- Table structure for table `tags`
-- 

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(30) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Represents folksonomy''s attributes generated by members';

