-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-2ubuntu1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 18, 2007 at 09:59 AM
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

-- 
-- Dumping data for table `choice_considerations`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `conditions`
-- 

INSERT INTO `conditions` (`id`, `referencedObjective`, `measureThreshold`, `operator`, `ruleCondition`, `rule_id`) VALUES 
(1, NULL, NULL, 'noOp', 'completed', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ControlMode: contenedor de información del sequencing' AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `control_modes`
-- 

INSERT INTO `control_modes` (`id`, `sco_id`, `choiceExit`, `choice`, `flow`, `forwardOnly`, `useCurrentAttemptObjectiveInfo`, `useCurrentAttemptProgressInfo`) VALUES 
(1, 324, 'true', 'true', 'true', 'false', 'true', 'true');

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

-- 
-- Dumping data for table `courses`
-- 


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

-- 
-- Dumping data for table `delivery_controls`
-- 


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

-- 
-- Dumping data for table `departments`
-- 


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

-- 
-- Dumping data for table `map_infos`
-- 


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

-- 
-- Dumping data for table `objectives`
-- 


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

-- 
-- Dumping data for table `plugins`
-- 


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

-- 
-- Dumping data for table `randomizations`
-- 


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

-- 
-- Dumping data for table `rollup_considerations`
-- 


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

-- 
-- Dumping data for table `rollups`
-- 


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `rules`
-- 

INSERT INTO `rules` (`id`, `sco_id`, `type`, `conditionCombination`, `action`, `minimumPercent`, `minimumCount`, `rollup_id`) VALUES 
(1, 254, 'exit', 'all', 'exit', '0.0000', '0', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `schema_info`
-- 

CREATE TABLE `schema_info` (
  `version` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `schema_info`
-- 


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

-- 
-- Dumping data for table `sco_presentations`
-- 


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
  `created` datetime NOT NULL COMMENT 'created time',
  `modified` datetime NOT NULL COMMENT 'modified time',
  `hash` varchar(35) collate utf8_unicode_ci NOT NULL COMMENT 'hash sum of file reference',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents a scorm asset in a course' AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `scorms`
-- 

INSERT INTO `scorms` (`id`, `course_id`, `name`, `file_name`, `description`, `version`, `created`, `modified`, `hash`) VALUES 
(1, 1, 'DMCE', 'SCORM2004.3.DMCE.1.1.zip', 'DMCE', '2004 3rd ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds each SCO from a SCORM package' AUTO_INCREMENT=325 ;

-- 
-- Dumping data for table `scos`
-- 

INSERT INTO `scos` (`id`, `scorm_id`, `parent_id`, `manifest`, `organization`, `identifier`, `href`, `title`, `completionThreshold`, `parameters`, `isvisible`, `attemptAbsoluteDurationLimit`, `dataFromLMS`, `attemptLimit`, `scormType`) VALUES 
(1, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'WELCOME', 'Welcome/welcome_01.html', 'Welcome', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(2, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'OVERVIEW', 'Overview/overview_01.html', 'Data Model Overview', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(3, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'CFLRN', NULL, 'Comments From Learner', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(4, 1, 3, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-FFA1F4D1-344F-2D98-7344-81A668D742C1', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(5, 1, 4, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-874F4EAD-07FB-2A8F-9864-0DB0E45521F0', 'Comments%20From%20Learner%20Content/cflrn_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(6, 1, 4, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-E0104E6A-C745-3FC2-44E2-EB5F1EE92901', 'Comments%20From%20Learner%20Content/cflrn_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(7, 1, 4, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-A39B2A32-1C8B-955B-FCA1-955E2116BB61', 'Comments%20From%20Learner%20Content/cflrn_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(8, 1, 3, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-EED8FCCD-52CD-6ED1-2099-9C2951D7989C', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(9, 1, 8, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-F007642D-6EAD-25DA-CC4B-CB5121BBFB3C', 'Comments%20From%20Learner%20Assessment/cflrn_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(10, 1, 8, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-D808577E-BC3A-9976-2251-D8F5DC1D2161', 'Comments%20From%20Learner%20Assessment/cflrn_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(11, 1, 8, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-7CB6DCC1-38F9-6C2B-6F60-18B52FD67D5D', 'Comments%20From%20Learner%20Assessment/cflrn_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(12, 1, 3, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-F7E723D3-23A0-CE6C-68F8-06F01C6EA97B', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(13, 1, 12, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-DC0D0030-6908-3C57-A7D3-647C5C680AB1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(14, 1, 12, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-A07AD10A-00E3-09AC-B681-9B827C37EC8E', 'Comments%20From%20Learner%20Application/cflrn_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(15, 1, 12, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-08F4726B-461C-77D3-D4EB-645CDAD4FF4D', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(16, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'CFLMS', NULL, 'Comments From LMS', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(17, 1, 16, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CFLMS_CC', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(18, 1, 17, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CFLMS_CC_INTRO', 'Comments%20From%20LMS%20Content/cflms_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(19, 1, 17, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-0D2BECC9-158E-EF7C-70AE-E697FD731D69', 'Comments%20From%20LMS%20Content/cflms_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(20, 1, 17, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CFLMS_CC_CONCL1', 'Comments%20From%20LMS%20Content/cflms_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(21, 1, 16, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-525636E3-FAEE-1F7D-975F-898CF47D5C03', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(22, 1, 21, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-664BD022-8B09-3EB2-C248-D01B53C6BF81', 'Comments%20From%20LMS%20Assessment/cflms_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(23, 1, 21, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-24355083-8D93-A9E0-B2D9-76B8B84AC039', 'Comments%20From%20LMS%20Assessment/cflms_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(24, 1, 21, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-6E396E8A-2D77-785E-CCF3-A01F1D9B75BB', 'Comments%20From%20LMS%20Assessment/cflms_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(25, 1, 16, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-F512399B-EF71-E6BD-AF1C-63F0786EB13A', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(26, 1, 25, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-EF44B115-D2F3-1419-4102-24F5C15D0813', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(27, 1, 25, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-541FB59E-3082-41CC-F6E2-DDA2010B4765', 'Comments%20From%20LMS%20Application/cflms_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(28, 1, 25, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-15634B96-CD79-3D90-ED48-34E495885C42', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(29, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'CS', NULL, 'Completion Status', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(30, 1, 29, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Completion_Status_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(31, 1, 30, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_CC_INTRO1', 'Completion%20Status%20Element%20Content/cs_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(32, 1, 30, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_CC1', 'Completion%20Status%20Element%20Content/cs_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(33, 1, 30, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_CC_CONCLUSION1', 'Completion%20Status%20Element%20Content/cs_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(34, 1, 29, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Completion_Status_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(35, 1, 34, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_CCA_INTRO1', 'Completion%20Status%20Element%20Assessment/cs_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(36, 1, 34, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_CCA1', 'Completion%20Status%20Element%20Assessment/cs_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(37, 1, 34, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_CCA_CONCLUSION1', 'Completion%20Status%20Element%20Assessment/cs_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(38, 1, 29, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CSLesson_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(39, 1, 38, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'cs_app_intro', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(40, 1, 38, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_APP1', 'Completion%20Status%20Element%20Application/cs_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(41, 1, 38, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CS_APP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(42, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'CT', NULL, 'Completion Threshold', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(43, 1, 42, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-87431FCF-816D-DF84-89CB-D844CCCB703F', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(44, 1, 43, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-ECC7F9C4-A146-7F12-E21F-BD0C96E04705', 'Completion%20Threshold%20Content/ct_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(45, 1, 43, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-63AEEF5F-AFBB-71B2-D634-C5E9D5A56C54', 'Completion%20Threshold%20Content/ct_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(46, 1, 43, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-55A16F39-9B86-34B8-39B0-808519D22FD5', 'Completion%20Threshold%20Content/ct_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(47, 1, 42, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-BE263DE8-DCD1-4E27-6C1A-298E169388E7', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(48, 1, 47, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-5B7E1DDF-CB4A-0C23-F1A6-857E78BBFF00', 'Completion%20Threshold%20Assessment/ct_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(49, 1, 47, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-491A801D-4A8D-0147-79AC-A452EEB08A5E', 'Completion%20Threshold%20Assessment/ct_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(50, 1, 47, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-28794047-638A-B562-A81F-F1B7970A5C70', 'Completion%20Threshold%20Assessment/ct_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(51, 1, 42, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-5A519323-1CBE-62AA-26AC-C19012041976', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(52, 1, 51, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-2BDFE485-AD4C-512F-E0D7-309A98FD770B', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(53, 1, 51, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-8CB644CD-9CD2-77F4-14C7-8313D6B0F420', 'Completion%20Threshold%20Application/ct_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(54, 1, 51, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-5F674642-F348-C81D-32B9-477D612CEE97', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(55, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'CREDIT', NULL, 'Credit', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(56, 1, 55, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Lesson_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(57, 1, 56, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Introduction', 'Credit%20Element%20Content/credit_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(58, 1, 56, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CREDIT_CC1', 'Credit%20Element%20Content/credit_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(59, 1, 56, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CREDIT_CC_CONCLUSION1', 'Credit%20Element%20Content/credit_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(60, 1, 55, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Lesson_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(61, 1, 60, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Assessment_intro', 'Credit%20Element%20Assessment/credit_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(62, 1, 60, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CC_ASSESSMENT1', 'Credit%20Element%20Assessment/credit_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(63, 1, 60, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CCA_CONCLUSION1', 'Credit%20Element%20Assessment/credit_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(64, 1, 55, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CREDITLesson_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(65, 1, 64, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'APP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(66, 1, 64, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'APPLICATION1', 'Credit%20Element%20Application/credit_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(67, 1, 64, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'APP_CONCLUSION', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(68, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'ENTRY', NULL, 'Entry', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(69, 1, 68, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'entry_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(70, 1, 69, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CC_INTRO1', 'Entry%20Element%20Content/entry_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(71, 1, 69, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CC1', 'Entry%20Element%20Content/entry_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(72, 1, 69, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CC_CONCLUSION1', 'Entry%20Element%20Content/entry_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(73, 1, 68, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'entry_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(74, 1, 73, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'cca_introduction', 'Entry%20Element%20Assessment/entry_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(75, 1, 73, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CCA1', 'Entry%20Element%20Assessment/entry_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(76, 1, 73, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'CCA_CONCLUSION_ENTRY1', 'Entry%20Element%20Assessment/entry_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(77, 1, 68, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'entry_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(78, 1, 77, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ENTRYAPP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(79, 1, 77, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'APP1', 'Entry%20Element%20Application/entry_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(80, 1, 77, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ENTRYAPP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(81, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'EXIT', NULL, 'Exit', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(82, 1, 81, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Exit_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(83, 1, 82, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXIT_CC_INTRO1', 'Exit%20Data%20Model%20Content/exit_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(84, 1, 82, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXIT_CC1', 'Exit%20Data%20Model%20Content/exit_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(85, 1, 82, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXIT_CC_CONCLUSION1', 'Exit%20Data%20Model%20Content/exit_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(86, 1, 81, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Exit_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(87, 1, 86, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXIT_CCA_INTRODUCTION1', 'Exit%20Data%20Model%20Assessment/exit_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(88, 1, 86, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXIT_CCA1', 'Exit%20Data%20Model%20Assessment/exit_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(89, 1, 86, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXIT_CCA_CONCLUSION1', 'Exit%20Data%20Model%20Assessment/exit_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(90, 1, 81, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Exit_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(91, 1, 90, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXITAPP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(92, 1, 90, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXIT_APP1', 'Exit%20Data%20Model%20Application/exit_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(93, 1, 90, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'EXITAPP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(94, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'INTERACTIONS', NULL, 'Interactions', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(95, 1, 94, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Interactions_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(96, 1, 95, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_CC_INTRO1', 'Interactions%20Element%20Content/interactions_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(97, 1, 95, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_CC1', 'Interactions%20Element%20Content/interactions_cc_interactions_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(98, 1, 95, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_CC_CONCLUSION1', 'Interactions%20Element%20Content/interactions_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(99, 1, 94, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Interactions_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(100, 1, 99, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_CCA_INTRO1', 'Interactions%20Element%20Assessment/interactions_cca_intro.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(101, 1, 99, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_CCA1', 'Interactions%20Element%20Assessment/interactions_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(102, 1, 99, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_CCA_CONCLUSION1', 'Interactions%20Element%20Assessment/interactions_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(103, 1, 94, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Interactions_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(104, 1, 103, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_APP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(105, 1, 103, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_APPLICATION1', 'Interactions%20Element%20Application/interactions_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(106, 1, 103, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'INTERACTIONS_APP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(107, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'LD', NULL, 'Launch Data', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(108, 1, 107, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CC', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(109, 1, 108, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CC-INTRO1', 'Launch%20Data%20Element%20Content/ld_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(110, 1, 108, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CC-CONTENT1', 'Launch%20Data%20Element%20Content/ld_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(111, 1, 108, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CC-CONC1', 'Launch%20Data%20Element%20Content/ld_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(112, 1, 107, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CCA', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(113, 1, 112, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CCA-INSTR1', 'Launch%20Data%20Element%20Assessment/ld_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(114, 1, 112, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CCA-ASSESS1', 'Launch%20Data%20Element%20Assessment/ld_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(115, 1, 112, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-CCA-CONCL1', 'Launch%20Data%20Element%20Assessment/ld_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(116, 1, 107, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(117, 1, 116, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP-INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(118, 1, 116, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP-APP1', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(119, 1, 118, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP-01X', 'Launch%20Data%20Element%20Application/ld_app_instructions.html', 'Instructions', NULL, NULL, 'false', NULL, 'ENGLISH', NULL, 'sco'),
(120, 1, 118, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP-02X', 'Launch%20Data%20Element%20Application/ld_app_manifest.html', 'Exercise 1 Spanish', NULL, NULL, 'false', NULL, 'SPANISH', NULL, 'sco'),
(121, 1, 118, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP-03X', 'Launch%20Data%20Element%20Application/ld_app_02.html', 'SCO-specific Glossary', NULL, NULL, 'false', NULL, 'LAUNCHDATA', NULL, 'sco'),
(122, 1, 118, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP-04X', 'Launch%20Data%20Element%20Application/ld_app_03.html', 'Testing Directions', NULL, NULL, 'false', NULL, 'During the following Assessment, you will be asked various types of questions, including multiple choice, fill-in-the-blank, true-false and matching. After completing each question, click the SUBMIT button. When you have submitted your answer, another screen will appear with feedback.\\n\\nThank you for participating in the Quality Control Course.', NULL, 'sco'),
(123, 1, 116, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LD-APP-CONCL1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(124, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'LID', NULL, 'Learner ID', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(125, 1, 124, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-A9667A19-632A-2B7C-884C-4133E091402B', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(126, 1, 125, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-4D82DCBA-030E-C682-9C7A-C7DF1788F97D', 'Learner%20ID%20Element%20Content/lid_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(127, 1, 125, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-0BBE1379-67DD-C912-E4A9-975D15B786AA', 'Learner%20ID%20Element%20Content/lid_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(128, 1, 125, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-8F8A9B5D-E77E-B6AE-28C0-01DA8466AB9C', 'Learner%20ID%20Element%20Content/lid_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(129, 1, 124, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-273A4716-6BEF-03A0-7EA8-DBD5211341FA', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(130, 1, 129, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-A702554F-AF57-B3D1-8A6A-04419E7F873E', 'Learner%20ID%20Element%20Assessment/lid_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(131, 1, 129, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-02CF2743-B343-7368-54F9-451A50868278', 'Learner%20ID%20Element%20Assessment/lid_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(132, 1, 129, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-A845D799-B768-B091-D2B4-EBC3ACAB9E94', 'Learner%20ID%20Element%20Assessment/lid_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(133, 1, 124, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-1415CFEF-E8C4-A636-8775-02AF9A1606AB', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(134, 1, 133, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-45A55D43-ABF8-21A1-EE8C-3DAAECC1E2EA', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(135, 1, 133, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-CEA72EC3-EA1C-4714-45BA-38F4AF71388D', 'Learner%20ID%20Element%20Application/lid_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(136, 1, 133, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-06F87465-DC7B-9C76-74F1-9476C5999B0D', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(137, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'LN', NULL, 'Learner%20Name', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(138, 1, 137, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CC', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(139, 1, 138, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CC_INTRO1', 'Learner%20Name%20Element%20Content/ln_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(140, 1, 138, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CC_CC1', 'Learner%20Name%20Element%20Content/ln_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(141, 1, 138, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CC_CONCL1', 'Learner%20Name%20Element%20Content/ln_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(142, 1, 137, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CCA', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(143, 1, 142, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CCA_INTRO1', 'Learner%20Name%20Element%20Assessment/ln_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(144, 1, 142, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CCA_CCA1', 'Learner%20Name%20Element%20Assessment/ln_cca_question_01.html', 'Assessement', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(145, 1, 142, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_CCA_CONCL1', 'Learner%20Name%20Element%20Assessment/ln_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(146, 1, 137, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_APP', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(147, 1, 146, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_APP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(148, 1, 146, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_APP_APP1', 'Learner%20Name%20Element%20Application/ln_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(149, 1, 146, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LN_APP_CONCL1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(150, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'LP', NULL, 'Learner Preference', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(151, 1, 150, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_Lesson_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(152, 1, 151, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_CC_INTRODUCTION1', 'Learner%20Preference%20Content/lp_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(153, 1, 151, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_CC1', 'Learner%20Preference%20Content/lp_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(154, 1, 151, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_CC_CONCLUSION1', 'Learner%20Preference%20Content/lp_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(155, 1, 150, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_Lesson_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(156, 1, 155, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_ASSESSMENT_INTRO1', 'Learner%20Preference%20Assessment/lp_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(157, 1, 155, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_CC_ASSESSMENT1', 'Learner%20Preference%20Assessment/lp_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(158, 1, 155, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_CCA_CONCLUSION1', 'Learner%20Preference%20Assessment/lp_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(159, 1, 150, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_Lesson_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(160, 1, 159, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_APP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(161, 1, 159, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_APPLICATION1', 'Learner%20Preference%20Application/lp_app_instructions.htm', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(162, 1, 159, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'LP_APP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(163, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'LOC', NULL, 'Location', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(164, 1, 163, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-6AE1EFA5-105F-43BB-6A63-5D1EC7BFD1A5', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(165, 1, 164, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-737099E7-9A87-7775-26A3-3B3A2DB47D37', 'Location%20Element%20Content/loc_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(166, 1, 164, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-358184B0-A96D-C24E-99D1-7B39F0F8C824', 'Location%20Element%20Content/loc_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(167, 1, 164, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-FF06A468-1C88-02C3-6F65-55D36F168E72', 'Location%20Element%20Content/loc_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(168, 1, 163, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-6E491E27-4DF1-DACE-0E73-04A1C64C94E0', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(169, 1, 168, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-0E279480-BD9C-8188-EC92-736813546B19', 'Location%20Element%20Assessment/loc_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(170, 1, 168, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-F589C257-E66E-90BA-CCA6-4C311E6E586A', 'Location%20Element%20Assessment/loc_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(171, 1, 168, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-729819CC-115E-9922-8BEA-73D336BA7AB0', 'Location%20Element%20Assessment/loc_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(172, 1, 163, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-23132D58-4015-6BAD-3089-CD854CF19F21', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(173, 1, 172, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-3A65427F-43D6-997A-D371-ED122A5E27F8', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(174, 1, 172, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-46097512-910E-6E8B-973A-7D52F93BB4C0', 'Location%20Element%20Application/loc_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(175, 1, 172, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-8E43868A-76BE-4655-2FBB-3A494DE375B9', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(176, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'MTA', NULL, 'Maximum Time Allowed', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(177, 1, 176, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MTA-CC', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(178, 1, 177, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MT-CC-INTRO1', 'Maximum%20Time%20Allowed%20Content/mt_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(179, 1, 177, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MT-CC-CONTENT1', 'Maximum%20Time%20Allowed%20Content/mt_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(180, 1, 177, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MT-CC-CONCL1', 'Maximum%20Time%20Allowed%20Content/mt_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(181, 1, 176, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MTA-CCA', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(182, 1, 181, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MT-CCA-INSTRUCT1', 'Maximum%20Time%20Allowed%20Assessment/mt_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(183, 1, 181, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MT-CCA-ASSESS1', 'Maximum%20Time%20Allowed%20Assessment/mt_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(184, 1, 181, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MT-CCA-CONCL1', 'Maximum%20Time%20Allowed%20Assessment/mt_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(185, 1, 176, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'MTA-APP', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(186, 1, 185, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-9F130976-962F-91CE-93EA-24FB1AE94FD1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(187, 1, 185, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-D054EB36-56B8-AC74-2B97-406A19B277C3', 'Maximum%20Time%20Allowed%20Application/mt_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(188, 1, 185, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-29208B82-F701-56AB-FFE0-B436F27FC335', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(189, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'MODE', NULL, 'Mode', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(190, 1, 189, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-EC297B30-7718-F5E8-3901-62A803E576E4', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(191, 1, 190, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-6889883D-5694-C03B-FEBC-203A934294AC', 'Mode%20Element%20Content/mode_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(192, 1, 190, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-4A35AA93-E9E9-3B7A-2F57-FAAD1602E9A4', 'Mode%20Element%20Content/mode_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(193, 1, 190, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-2E50FE69-2BD0-0EE3-5196-D29FFD23CCB0', 'Mode%20Element%20Content/mode_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(194, 1, 189, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-40913F24-131B-1E9B-26B1-D37A971A5132', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(195, 1, 194, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-D7DF6D66-509B-81F7-AB08-9EF54E5F09B6', 'Mode%20Element%20Assessment/mode_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(196, 1, 194, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-A52CA810-9F2D-0AE6-45C5-0B7550604911', 'Mode%20Element%20Assessment/mode_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(197, 1, 194, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-688D5D5B-F161-D49F-A2FD-9E550AF91009', 'Mode%20Element%20Assessment/mode_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(198, 1, 189, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-15B126F4-FD13-933A-9535-ED7159303F11', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(199, 1, 198, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-0A698615-B196-1ADE-23A0-51D4EDA4B885', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(200, 1, 198, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-445D0030-E9DE-46B9-CAF0-9F5967CFE20D', 'Mode%20Element%20Application/mode_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(201, 1, 198, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-37C43872-638D-7140-FDED-4DAF08EAFCA9', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(202, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'OBJ', NULL, 'Objectives', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(203, 1, 202, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-2A08C97B-0D1A-3A97-282B-9BCCBEE62262', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(204, 1, 203, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-6DD8D434-D4CA-4D31-DB45-CA4C1AC8C412', 'Objectives%20Element%20Content/obj_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(205, 1, 203, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-178DCD67-7277-BC13-7695-4AECA28BE529', 'Objectives%20Element%20Content/obj_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(206, 1, 203, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-9CA0C6B8-0F34-B50C-5334-80C88DB3988E', 'Objectives%20Element%20Content/obj_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(207, 1, 202, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-0ECC73AA-9943-3B18-BE05-2DCDD58C0371', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(208, 1, 207, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-074239B2-2E8A-CE51-E400-70C876EDF06A', 'Objectives%20Element%20Assessment/obj_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(209, 1, 207, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-BAA6E47E-294A-E186-F82D-26CD1FA87659', 'Objectives%20Element%20Assessment/obj_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(210, 1, 207, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-45A1224F-6BDB-EFF7-8112-D42D0AD2421D', 'Objectives%20Element%20Assessment/obj_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(211, 1, 202, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-1CEF4BC8-5B38-3556-F21D-2338FF0EC831', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(212, 1, 211, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-34E828E8-B79C-BDF8-1631-4560702B28F7', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(213, 1, 211, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-11725A10-BB33-F01E-9BDF-E9869A789299', 'Objectives%20Element%20Application/obj_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(214, 1, 211, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-DC6D856E-2D5D-7A4F-66F7-4A85C4BB53D6', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(215, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'PM', NULL, 'Progress Measure', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(216, 1, 215, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMLesson_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(217, 1, 216, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMINTRODUCTION1', 'Progress%20Measure%20Element%20Content/pm_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(218, 1, 216, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PM_CC1', 'Progress%20Measure%20Element%20Content/pm_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(219, 1, 216, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PM_CC_CONCLUSION1', 'Progress%20Measure%20Element%20Content/pm_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(220, 1, 215, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMLesson_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(221, 1, 220, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMASSESSMENT_INTRO1', 'Progress%20Measure%20Element%20Assessment/pm_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(222, 1, 220, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMCc_ASSESSMENT1', 'Progress%20Measure%20Element%20Assessment/pm_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(223, 1, 220, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMCCA_CONCLUSION1', 'Progress%20Measure%20Element%20Assessment/pm_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(224, 1, 215, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMLesson_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(225, 1, 224, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMAPP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(226, 1, 224, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMAPPLICATION1', 'Progress%20Measure%20Element%20Application/pm_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(227, 1, 224, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'PMAPP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(228, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'SPS', NULL, 'Scaled Passing Score', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(229, 1, 228, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-AAE9778A-BDB2-6197-5172-E5CE8D7D234B', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(230, 1, 229, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-039A7646-6C93-3947-4EDE-5C41A04F5A26', 'Scaled%20Passing%20Score%20Content/sps_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(231, 1, 229, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-63CF0DE2-A723-229A-1185-2178084D7B05', 'Scaled%20Passing%20Score%20Content/sps_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(232, 1, 229, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-6BB7CDBB-0A0D-9FDE-6CD8-88CA36D712A8', 'Scaled%20Passing%20Score%20Content/sps_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(233, 1, 228, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-61D3DC5D-0D65-77DA-0832-E03C7B6DF540', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(234, 1, 233, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-12124B07-F524-684D-4C4B-F28A996B59E1', 'Scaled%20Passing%20Score%20Assessment/sps_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(235, 1, 233, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-C16C24E8-16FD-1AB5-F423-9922EF721F7D', 'Scaled%20Passing%20Score%20Assessment/sps_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(236, 1, 233, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-2522C6F1-B41D-A254-C7A1-7BC0F3D6B6BF', 'Scaled%20Passing%20Score%20Assessment/sps_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(237, 1, 228, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-D5782ACA-A57B-2DCE-FF75-967C51D1556A', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(238, 1, 237, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-45100950-4DBF-5381-57A9-4A873FBF7999', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(239, 1, 237, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-84DA90ED-965A-F640-166F-A2EA1C036FA6', 'Scaled%20Passing%20Score%20Application/sps_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(240, 1, 237, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-2E02E970-52FD-A177-7866-A3EB01431C43', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(241, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'SCORE', NULL, 'Score', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(242, 1, 241, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Score_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(243, 1, 242, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_CC_INTRO1', 'Score%20Element%20Content/score_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(244, 1, 242, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_CC1', 'Score%20Element%20Content/score_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(245, 1, 242, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_CC_CONCLUSION1', 'Score%20Element%20Content/score_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(246, 1, 241, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Score_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(247, 1, 246, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_CCA_INTRO1', 'Score%20Element%20Assessment/score_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(248, 1, 246, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_CCA1', 'Score%20Element%20Assessment/score_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(249, 1, 246, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_CCA_CONCLUSION1', 'Score%20Element%20Assessment/score_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(250, 1, 241, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'Score_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(251, 1, 250, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_APP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(252, 1, 250, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_APP1', 'Score%20Element%20Application/score_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(253, 1, 250, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'SCORE_APP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(254, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'ST', NULL, 'Session Time', NULL, NULL, 'true', NULL, NULL, NULL, NULL);
INSERT INTO `scos` (`id`, `scorm_id`, `parent_id`, `manifest`, `organization`, `identifier`, `href`, `title`, `completionThreshold`, `parameters`, `isvisible`, `attemptAbsoluteDurationLimit`, `dataFromLMS`, `attemptLimit`, `scormType`) VALUES 
(255, 1, 254, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STLesson_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(256, 1, 255, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ST_INTRODUCTION1', 'Session%20Time%20Element%20Content/st_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(257, 1, 255, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ST_CC1', 'Session%20Time%20Element%20Content/st_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(258, 1, 255, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ST_CC_CONCLUSION1', 'Session%20Time%20Element%20Content/st_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(259, 1, 254, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STLesson_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(260, 1, 259, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STASSESSMENT_INTRO', 'Session%20Time%20Element%20Assessment/st_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(261, 1, 259, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STCC_ASSESSMENT1', 'Session%20Time%20Element%20Assessment/st_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(262, 1, 259, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STCCA_CONCLUSION1', 'Session%20Time%20Element%20Assessment/st_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(263, 1, 254, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STLesson_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(264, 1, 263, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STAPP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(265, 1, 263, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STAPPLICATION1', 'Session%20Time%20Element%20Application/st_app_instructions.htm', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(266, 1, 263, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'STAPP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(267, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'SS', NULL, 'Success Status', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(268, 1, 267, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-F6DB7BE3-84FB-AE08-2071-F86F2ED72E9C', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(269, 1, 268, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-481ACB33-D0A9-E8E7-97A5-30D786099092', 'Success%20Status%20Element%20Content/ss_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(270, 1, 268, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-BC28CE59-D237-EB4C-7F57-EE33C5FAEC6B', 'Success%20Status%20Element%20Content/ss_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(271, 1, 268, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-5AD1C278-2853-A59D-3355-A4320438FB7F', 'Success%20Status%20Element%20Content/ss_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(272, 1, 267, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-D2B4D119-3B4D-8FE2-2A80-A51DDA645B68', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(273, 1, 272, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-BD293996-CA38-6D7B-8897-E0E72B7AC495', 'Success%20Status%20Element%20Assessment/ss_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(274, 1, 272, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-943AC5CF-48F4-BFCA-DCD8-726173B20FB7', 'Success%20Status%20Element%20Assessment/ss_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(275, 1, 272, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-00BC8DB5-052A-A738-49F6-6462696A6197', 'Success%20Status%20Element%20Assessment/ss_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(276, 1, 267, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-35340FF7-BB8D-C81D-2965-017B948F085C', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(277, 1, 276, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-6CB1A49C-9ABC-AB75-E9ED-C84221984BBE', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(278, 1, 276, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-D36A6514-953E-4748-2E83-2D91C05525BD', 'Success%20Status%20Element%20Application/ss_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(279, 1, 276, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-2C73391C-CA59-4481-8264-13B1F76EBA91', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(280, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'SD', NULL, 'Suspend Data', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(281, 1, 280, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-CA11D6E7-AB85-E92D-8FF5-91EE82A55FF0', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(282, 1, 281, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-3AEF55DC-4283-0CD0-9CC3-7F6A1E442F43', 'Suspend%20Data%20Element%20Content/sd_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(283, 1, 281, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-A20306C8-DAFE-EDFB-5692-292902EEB563', 'Suspend%20Data%20Element%20Content/sd_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(284, 1, 281, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-F1B4A93C-0AAC-6FB7-ADF1-568FA07F52EA', 'Suspend%20Data%20Element%20Content/sd_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(285, 1, 280, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-48D3AEE6-F242-5EB9-E741-D55644B1848C', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(286, 1, 285, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-FC16A263-9EA1-42C0-CCF5-1089F72760CB', 'Suspend%20Data%20Element%20Assessment/sd_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(287, 1, 285, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-59BB100C-EB7C-741E-5298-28E8ABF84915', 'Suspend%20Data%20Element%20Assessment/sd_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(288, 1, 285, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-4635FC24-D490-58CD-EBB6-71847B7C43C2', 'Suspend%20Data%20Element%20Assessment/sd_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(289, 1, 280, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-0564FF30-BA0C-FB29-1F66-C4A62152E185', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(290, 1, 289, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-92831A2D-7EB6-90A3-E2A0-C8B762790F0E', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(291, 1, 289, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-99381597-F89E-D37A-150C-C7266C944F2A', 'Suspend%20Data%20Element%20Application/sd_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(292, 1, 289, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'ITEM-B6A8FEFF-8A58-9B5D-2AEB-D486BAF0FD17', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(293, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'TLA', NULL, 'Time Limit Action', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(294, 1, 293, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-AAE9778A-BDB2-6197-5172-E5CE8D7D234B', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(295, 1, 294, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-039A7646-6C93-3947-4EDE-5C41A04F5A26', 'Time%20Limit%20Action%20Content/tla_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(296, 1, 294, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-63CF0DE2-A723-229A-1185-2178084D7B05', 'Time%20Limit%20Action%20Content/tla_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(297, 1, 294, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-6BB7CDBB-0A0D-9FDE-6CD8-88CA36D712A8', 'Time%20Limit%20Action%20Content/tla_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(298, 1, 293, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-61D3DC5D-0D65-77DA-0832-E03C7B6DF540', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(299, 1, 298, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-12124B07-F524-684D-4C4B-F28A996B59E1', 'Time%20Limit%20Action%20Assessment/tla_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(300, 1, 298, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-C16C24E8-16FD-1AB5-F423-9922EF721F7D', 'Time%20Limit%20Action%20Assessment/tla_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(301, 1, 298, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-2522C6F1-B41D-A254-C7A1-7BC0F3D6B6BF', 'Time%20Limit%20Action%20Assessment/tla_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(302, 1, 293, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-D5782ACA-A57B-2DCE-FF75-967C51D1556A', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(303, 1, 302, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-45100950-4DBF-5381-57A9-4A873FBF7999', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(304, 1, 302, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-84DA90ED-965A-F640-166F-A2EA1C036FA6', 'Time%20Limit%20Action%20Application/tla_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(305, 1, 302, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TLAITEM-2E02E970-52FD-A177-7866-A3EB01431C43', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(306, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'TT', NULL, 'Total Time', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(307, 1, 306, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTLesson_01', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(308, 1, 307, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTINTRODUCTION1', 'Total%20Time%20Element%20Content/tt_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(309, 1, 307, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TT_CC1', 'Total%20Time%20Element%20Content/tt_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(310, 1, 307, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TT_CC_CONCLUSION1', 'Total%20Time%20Element%20Content/tt_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(311, 1, 306, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTLesson_02', NULL, 'Conceptual Content Assessment', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(312, 1, 311, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTASSESSMENT_INTRO1', 'Total%20Time%20Element%20Assessment/tt_cca_instructions.html', 'Instructions', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(313, 1, 311, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTCC_ASSESSMENT1', 'Total%20Time%20Element%20Assessment/tt_cca_question_01.html', 'Assessment', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(314, 1, 311, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTCCA_CONCLUSION1', 'Total%20Time%20Element%20Assessment/tt_cca_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(315, 1, 306, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTLesson_03', NULL, 'Application', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(316, 1, 315, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTAPP_INTRO1', 'Shared%20Files/sharable%20content%20objects/app_intro.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(317, 1, 315, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTAPPLICATION1', 'Total%20Time%20Element%20Application/tt_app_instructions.html', 'Application', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(318, 1, 315, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'TTAPP_CONCLUSION1', 'Shared%20Files/sharable%20content%20objects/app_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(319, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'VERSION', NULL, 'Data Model Version', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(320, 1, 319, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'VERSION_CC', NULL, 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, NULL),
(321, 1, 320, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'VERSION_CC-INTRO1', 'Version%20Element%20Content/v_cc_introduction.html', 'Introduction', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(322, 1, 320, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'VERSION_CC-CC1', 'Version%20Element%20Content/v_cc_01.html', 'Conceptual Content', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(323, 1, 320, 'LMSTestPackage_RU-12b', 'LMSTestPackage_RU-12b', 'VERSION_CC-CONCLUSION1', 'Version%20Element%20Content/v_cc_conclusion.html', 'Conclusion', NULL, NULL, 'true', NULL, NULL, NULL, 'sco'),
(324, 1, NULL, 'LMSTestPackage_RU-12b', 'DMCE', 'FEEDBACK1', 'Feedback/feedback_01.html', 'Feedback', NULL, NULL, 'true', NULL, NULL, NULL, 'sco');
