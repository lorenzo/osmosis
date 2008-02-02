-- phpMyAdmin SQL Dump
-- version 2.10.3deb1ubuntu0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 02, 2008 at 06:55 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3-1ubuntu6.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `osmosis`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `locker_documents`
-- 

CREATE TABLE IF NOT EXISTS `locker_documents` (
  `id` int(11) NOT NULL auto_increment COMMENT 'document id',
  `description` text NOT NULL COMMENT 'document''s description',
  `locker_id` int(11) NOT NULL COMMENT 'locker''s id in which the document resides',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Documents in a locker' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `locker_lockers`
-- 

CREATE TABLE IF NOT EXISTS `locker_lockers` (
  `id` int(11) NOT NULL auto_increment COMMENT 'Locker id',
  `member_id` int(11) NOT NULL COMMENT 'Locker''s owner id',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='User''s locker for the delivery of documents' AUTO_INCREMENT=1 ;

