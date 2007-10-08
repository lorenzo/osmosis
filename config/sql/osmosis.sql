-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2007 at 09:09 PM
-- Server version: 5.0.37
-- PHP Version: 5.2.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `osmosis2`
--

-- --------------------------------------------------------

--
-- Table structure for table `conditions`
--

CREATE TABLE IF NOT EXISTS `conditions` (
  `id` int(11) NOT NULL auto_increment,
  `referencedObjective` varchar(255) default NULL,
  `measureThreshold` varchar(7) default NULL,
  `operator` varchar(4) default 'noOp',
  `ruleCondition` varchar(27) NOT NULL,
  `rule_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `conditions`
--


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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `courses`
--


-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`) VALUES
(1, 'Departamento de BiologÃ­a Celular', 'Todas las asignaturas cuyos cÃ³digos sean de la forma BC, EP, GP.');

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

--
-- Dumping data for table `plugins`
--


-- --------------------------------------------------------

--
-- Table structure for table `rollups`
--

CREATE TABLE IF NOT EXISTS `rollups` (
  `id` int(11) NOT NULL auto_increment,
  `rollupObjectiveSatisfied` varchar(5) default 'true',
  `rollupProgressCompletion` varchar(5) default 'true',
  `objectiveMeasureWeight` varchar(20) default '1.0000',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rollups`
--


-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(4) default NULL,
  `conditionCombination` varchar(3) default 'all',
  `action` varchar(20) default NULL,
  `minimumPercent` varchar(6) default '0.0000',
  `minimumCount` varchar(5) default '0',
  `rollup_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rules`
--


-- --------------------------------------------------------

--
-- Table structure for table `schema_info`
--

CREATE TABLE IF NOT EXISTS `schema_info` (
  `version` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schema_info`
--

INSERT INTO `schema_info` (`version`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `scorms`
--

CREATE TABLE IF NOT EXISTS `scorms` (
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE `map_infos` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `objective_id` int(11) NOT NULL,
  `targetObjectiveID` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'the identifier of the global shared objective',
  `readSatisfiedStatus` varchar(5) collate utf8_unicode_ci default 'true',
  `readNormalizedMeasure` varchar(5) collate utf8_unicode_ci NOT NULL default 'true',
  `writeSatisfiedStatus` varchar(5) collate utf8_unicode_ci default 'false',
  `writeNormalizedMeasure` varchar(5) collate utf8_unicode_ci default 'false',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents the mapping of an activity’s objective' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `objectives`
-- 

CREATE TABLE `objectives` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `satisfiedByMeasure` varchar(5) collate utf8_unicode_ci default 'false' COMMENT 'indicates that minNormalizedMeasure shall be used intead of other method',
  `minNormalizedMeasure` varchar(3) collate utf8_unicode_ci NOT NULL default '1.0' COMMENT 'identifies minimum satisfaction measure for the objective',
  `objectiveID` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'objective ID',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='identifies objectives that do not contribute to rollup assoc' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `randomizations`
-- 

CREATE TABLE `randomizations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `randomizationTiming` varchar(16) collate utf8_unicode_ci default 'never' COMMENT 'indicates when the ordering of the children of the activity should occur',
  `selectCount` int(11) unsigned default NULL COMMENT 'indicates the number of child activities that must be selected',
  `reorderChildren` varchar(5) collate utf8_unicode_ci NOT NULL default 'false' COMMENT 'indicates that the order of the child activities is randomized',
  `selectionTiming` varchar(16) collate utf8_unicode_ci default 'never' COMMENT 'indicates when the selection should occur',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scos`
-- 

CREATE TABLE `scos` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'Primary key',
  `scorm_id` int(11) unsigned NOT NULL COMMENT 'Scorm package this sco belongs to',
  `parent_id` int(11) unsigned default NULL COMMENT 'The parent sco',
  `manifest` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'The manifest that contains this sco',
  `organization` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'The organization that contains this sco',
  `identifier` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'Identifier string for sco',
  `href` varchar(255) collate utf8_unicode_ci default NULL COMMENT 'Reference to the location to launch',
  `title` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'Title for sco',
  `completionThreshold` varchar(3) collate utf8_unicode_ci default NULL COMMENT ' defines a threshold value that can be used by the SCO',
  `parameters` text collate utf8_unicode_ci COMMENT 'static parameters to be passed to the resource at launch time',
  `isvisible` varchar(5) collate utf8_unicode_ci NOT NULL default 'true' COMMENT 'indicates whether or not this SCO is displayed when the structure of the package is displayed or rendered',
  `attemptAbsoluteDurationLimit` varchar(6) collate utf8_unicode_ci default NULL COMMENT 'maximum time duration that the learner is permitted to spend on any single learner attempt',
  `dataFromLMS` text collate utf8_unicode_ci COMMENT 'provides initialization data expected by the',
  `attemptLimit` varchar(10) collate utf8_unicode_ci default NULL COMMENT ' the maximum number of attempts for the activity',
  `scormType` varchar(6) collate utf8_unicode_ci NOT NULL COMMENT 'type of SCORM resource',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds each SCO from a SCORM package' AUTO_INCREMENT=1 ;
