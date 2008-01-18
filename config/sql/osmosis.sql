-- phpMyAdmin SQL Dump
-- version 2.10.3deb1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 06, 2007 at 02:33 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3-1ubuntu6

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- Table structure for table `courses`
-- 

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `department_id` int(4) unsigned NOT NULL,
  `owner_id` int(11) NOT NULL,
  `code` varchar(10) collate utf8_unicode_ci NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

-- 
-- Table structure for table `departments`
-- 

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents a registered user' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `plugins`
-- 

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` smallint(4) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds installed plugin names and active status' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

