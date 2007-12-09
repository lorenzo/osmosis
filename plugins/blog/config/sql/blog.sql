-- phpMyAdmin SQL Dump
-- version 2.10.3deb1ubuntu0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Dec 08, 2007 at 12:54 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3-1ubuntu6.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `osmosis`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `blog_blogs`
-- 

CREATE TABLE IF NOT EXISTS `blog_blogs` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `owner` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `blog_comments`
-- 

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `blog_posts`
-- 

CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(50) default NULL,
  `body` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  `blog_id` int(11) NOT NULL,
  `slug` text NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

