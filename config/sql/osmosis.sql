-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-2ubuntu1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 11, 2007 at 04:07 PM
-- Server version: 5.0.38
-- PHP Version: 5.2.1
-- 
-- Database: `osmosis`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `choice_considerations`
-- 

CREATE TABLE `choice_considerations` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `preventActivation` varchar(5) NOT NULL default 'false',
  `constrainChoice` varchar(5) NOT NULL default 'false',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='choice_considerations' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `conditions`
-- 

CREATE TABLE `conditions` (
  `id` int(11) NOT NULL auto_increment,
  `referencedObjective` varchar(255) character set latin1 default NULL,
  `measureThreshold` varchar(7) character set latin1 default NULL,
  `operator` varchar(4) character set latin1 default 'noOp',
  `ruleCondition` varchar(27) character set latin1 NOT NULL,
  `rule_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `control_modes`
-- 

CREATE TABLE `control_modes` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `choiceExit` varchar(5) NOT NULL default 'true',
  `choice` varchar(5) NOT NULL default 'true',
  `flow` varchar(5) NOT NULL default 'false',
  `forwardOnly` varchar(5) NOT NULL default 'false',
  `useCurrentAttemptObjectiveInfo` varchar(5) NOT NULL default 'true',
  `useCurrentAttemptProgressInfo` varchar(5) NOT NULL default 'true',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ControlMode: contenedor de información del sequencing' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `courses`
-- 

CREATE TABLE `courses` (
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
-- Table structure for table `delivery_controls`
-- 

CREATE TABLE `delivery_controls` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `tracked` varchar(5) NOT NULL default 'true',
  `completionSetByContent` varchar(5) NOT NULL default 'false',
  `objectiveSetByContent` varchar(5) NOT NULL default 'false',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='DeliveryControl: secuencia que deben seguir las actividades' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `departments`
-- 

CREATE TABLE `departments` (
  `id` int(4) unsigned NOT NULL auto_increment,
  `name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `map_infos`
-- 

CREATE TABLE `map_infos` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `objective_id` int(11) NOT NULL,
  `targetObjectiveID` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'the identifier of the global shared objective',
  `readSatisfiedStatus` varchar(5) collate utf8_unicode_ci default 'true',
  `readNormalizedMeasure` varchar(5) collate utf8_unicode_ci NOT NULL default 'true',
  `writeSatisfiedStatus` varchar(5) collate utf8_unicode_ci default 'false',
  `writeNormalizedMeasure` varchar(5) collate utf8_unicode_ci default 'false',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents the mapping of an activity’s objective' AUTO_INCREMENT=1 ;

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
  `primary` tinyint(1) NOT NULL default '0' COMMENT 'indicates whether is a primary objective or not',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='identifies objectives that do not contribute to rollup assoc' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `plugins`
-- 

CREATE TABLE `plugins` (
  `id` smallint(4) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds installed plugin names and active status' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `randomizations`
-- 

CREATE TABLE `randomizations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `randomizationTiming` varchar(16) collate utf8_unicode_ci default 'never' COMMENT 'indicates when the ordering of the children of the activity should occur',
  `selectCount` int(11) unsigned default NULL COMMENT 'indicates the number of child activities that must be selected',
  `reorderChildren` varchar(5) collate utf8_unicode_ci NOT NULL default 'false' COMMENT 'indicates that the order of the child activities is randomized',
  `selectionTiming` varchar(16) collate utf8_unicode_ci default 'never' COMMENT 'indicates when the selection should occur',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `rollup_considerations`
-- 

CREATE TABLE `rollup_considerations` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `requiredForSatisfied` varchar(15) NOT NULL default 'always',
  `requiredForNotSatisfied` varchar(15) NOT NULL default 'always',
  `requiredForComplete` varchar(15) NOT NULL default 'always',
  `requiredForIncomplete` varchar(15) NOT NULL default 'always',
  `measureSatisfactionIfActive` varchar(5) NOT NULL default 'true',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='RollupConsideration:indican cuándo una actividad debe ser i' AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `rollups`
-- 

CREATE TABLE `rollups` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `rollupObjectiveSatisfied` varchar(5) default 'true',
  `rollupProgressCompletion` varchar(5) default 'true',
  `objectiveMeasureWeight` varchar(20) default '1.0000',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `rules`
-- 

CREATE TABLE `rules` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) default NULL,
  `type` varchar(4) default NULL,
  `conditionCombination` varchar(3) default 'all',
  `action` varchar(20) default NULL,
  `minimumPercent` varchar(6) default '0.0000',
  `minimumCount` varchar(5) default '0',
  `rollup_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `schema_info`
-- 

CREATE TABLE `schema_info` (
  `version` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `sco_presentations`
-- 

CREATE TABLE `sco_presentations` (
  `id` int(11) NOT NULL auto_increment,
  `hideKey` varchar(10) NOT NULL,
  `sco_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='SCOPresentation: información de la presentación de una act' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorms`
-- 

CREATE TABLE `scorms` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'primary key',
  `course_id` int(11) NOT NULL COMMENT 'foreign key to course',
  `name` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'name for scorm asset',
  `file_name` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'file name of scorm package',
  `description` text collate utf8_unicode_ci NOT NULL COMMENT 'description of scorm asset',
  `version` varchar(9) collate utf8_unicode_ci NOT NULL COMMENT 'scorm version',
  `created` timestamp NOT NULL default '0000-00-00 00:00:00' COMMENT 'created time',
  `modified` timestamp NOT NULL default '0000-00-00 00:00:00' COMMENT 'modified time',
  `hash` varchar(35) collate utf8_unicode_ci NOT NULL COMMENT 'hash sum of file reference',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents a scorm asset in a course' AUTO_INCREMENT=1 ;

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
  `scormType` varchar(6) collate utf8_unicode_ci default NULL COMMENT 'type of SCORM resource',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds each SCO from a SCORM package' AUTO_INCREMENT=1 ;

