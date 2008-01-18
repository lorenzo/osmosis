-- phpMyAdmin SQL Dump
-- version 2.10.3deb1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 17, 2008 at 11:34 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `blog_blogs`
-- 

CREATE TABLE IF NOT EXISTS `blog_blogs` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `member_id` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `blog_comments`
-- 

CREATE TABLE IF NOT EXISTS `blog_comments` (
  `id` int(11) NOT NULL auto_increment,
  `comment` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents a registered user' AUTO_INCREMENT=2 ;

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

-- 
-- Table structure for table `quiz_association_choices`
-- 

CREATE TABLE IF NOT EXISTS `quiz_association_choices` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `association_question_id` char(36) collate utf8_unicode_ci NOT NULL COMMENT 'Related Choice Question',
  `text` text collate utf8_unicode_ci NOT NULL COMMENT 'Text for this choce',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Association Questions'' choices';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_association_questions`
-- 

CREATE TABLE IF NOT EXISTS `quiz_association_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `body` text NOT NULL COMMENT 'The questions wording',
  `shuffle` tinyint(1) NOT NULL COMMENT 'Set the ordr of the choices randomly',
  `max_associations` int(11) NOT NULL COMMENT 'Maximum number of choices that the candidate is allowed to select. If maxChoices is 0 then there is no restriction. If maxChoices is greater than 1 (or 0) then the interaction must be bound to a response with multiple cardinality',
  `min_associations` int(11) default NULL COMMENT 'Minimum number of choices that the candidate is required to select to form a valid response. If minChoices is 0 then the candidate is not required to select any choices. minChoices must be less than or equal to the limit imposed by maxChoices.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='The candidate''s task is to select one or more of the choices';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_association_questions_quizzes`
-- 

CREATE TABLE IF NOT EXISTS `quiz_association_questions_quizzes` (
  `id` int(11) NOT NULL auto_increment,
  `association_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Relates a Association Question with a Quiz (many-to-many)' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_choice_choices`
-- 

CREATE TABLE IF NOT EXISTS `quiz_choice_choices` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `choice_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Related Choice Question',
  `text` text NOT NULL COMMENT 'Text for this choce',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Choice Questions'' choices';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_choice_questions`
-- 

CREATE TABLE IF NOT EXISTS `quiz_choice_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `body` text NOT NULL COMMENT 'The questions wording',
  `shuffle` tinyint(1) NOT NULL COMMENT 'Set the order of the choices randomly',
  `max_choices` int(11) NOT NULL COMMENT 'Maximum number of choices that the candidate is allowed to select. If maxChoices is 0 then there is no restriction. If maxChoices is greater than 1 (or 0) then the interaction must be bound to a response with multiple cardinality',
  `min_choices` int(11) default NULL COMMENT 'Minimum number of choices that the candidate is required to select to form a valid response. If minChoices is 0 then the candidate is not required to select any choices. minChoices must be less than or equal to the limit imposed by maxChoices.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Selection one or more of the available choices';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_choice_questions_quizzes`
-- 

CREATE TABLE IF NOT EXISTS `quiz_choice_questions_quizzes` (
  `id` char(36) NOT NULL,
  `choice_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Choice Question with a Quiz (many-to-many)';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_cloze_questions`
-- 

CREATE TABLE IF NOT EXISTS `quiz_cloze_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'The questions title',
  `body` text NOT NULL COMMENT 'The questions wording',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Embedded Answer Question (Cloze format)';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_cloze_questions_quizzes`
-- 

CREATE TABLE IF NOT EXISTS `quiz_cloze_questions_quizzes` (
  `id` char(36) NOT NULL,
  `cloze_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Cloze Question with a Quiz (many-to-many)';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_matching_choices`
-- 

CREATE TABLE IF NOT EXISTS `quiz_matching_choices` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `matching_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Related Choice Question',
  `text` text NOT NULL COMMENT 'Text for this choce',
  `source` blob NOT NULL COMMENT 'Wether this choice belongs o the source set or the target set',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Matching Questions'' choices';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_matching_questions`
-- 

CREATE TABLE IF NOT EXISTS `quiz_matching_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `body` text NOT NULL COMMENT 'The questions wording',
  `shuffle` tinyint(1) NOT NULL COMMENT 'Set the ordr of the choices randomly',
  `max_associations` int(11) NOT NULL COMMENT 'Maximum number of choices that the candidate is allowed to select. If maxChoices is 0 then there is no restriction. If maxChoices is greater than 1 (or 0) then the interaction must be bound to a response with multiple cardinality',
  `min_associations` int(11) default NULL COMMENT 'Minimum number of choices that the candidate is required to select to form a valid response. If minChoices is 0 then the candidate is not required to select any choices. minChoices must be less than or equal to the limit imposed by maxChoices.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Matching: Associate pairs of choices from two sets';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_matching_questions_quizzes`
-- 

CREATE TABLE IF NOT EXISTS `quiz_matching_questions_quizzes` (
  `id` char(36) NOT NULL,
  `matching_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Matching Question with a Quiz (many-to-many)';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_ordering_choices`
-- 

CREATE TABLE IF NOT EXISTS `quiz_ordering_choices` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ordering_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Related Choice Question',
  `text` text NOT NULL COMMENT 'Text for this choce',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Ordering Questions'' choices';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_ordering_questions`
-- 

CREATE TABLE IF NOT EXISTS `quiz_ordering_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `body` text NOT NULL COMMENT 'The questions wording',
  `shuffle` tinyint(1) NOT NULL COMMENT 'Set the ordr of the choices randomly',
  `max_choices` int(11) NOT NULL COMMENT 'Maximum number of choices that the candidate is allowed to select. If maxChoices is 0 then there is no restriction. If maxChoices is greater than 1 (or 0) then the interaction must be bound to a response with multiple cardinality',
  `min_choices` int(11) default NULL COMMENT 'Minimum number of choices that the candidate is required to select to form a valid response. If minChoices is 0 then the candidate is not required to select any choices. minChoices must be less than or equal to the limit imposed by maxChoices.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='The candidate''s task is to select one or more of the choices';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_ordering_questions_quizzes`
-- 

CREATE TABLE IF NOT EXISTS `quiz_ordering_questions_quizzes` (
  `id` char(36) NOT NULL,
  `ordering_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Choice Question with a Quiz (many-to-many)';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_quizzes`
-- 

CREATE TABLE IF NOT EXISTS `quiz_quizzes` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'Title of the quiz',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Registered Quizzes';

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_text_questions`
-- 

CREATE TABLE IF NOT EXISTS `quiz_text_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'The questions title',
  `body` text NOT NULL COMMENT 'The questions wording',
  `format` varchar(5) NOT NULL COMMENT 'plain, pre or xhtml',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_text_questions_quizzes`
-- 

CREATE TABLE IF NOT EXISTS `quiz_text_questions_quizzes` (
  `id` char(36) NOT NULL,
  `text_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Text Question with a Quiz (many-to-many)';

-- --------------------------------------------------------

-- 
-- Table structure for table `roles`
-- 

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `role` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents groups of users with permissions' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_attendee_trackings`
-- 

CREATE TABLE IF NOT EXISTS `scorm_attendee_trackings` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `datamodel_element` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Some SCORM-RTE datamodel element',
  `value` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `scorm_id` (`sco_id`,`student_id`,`datamodel_element`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Keeps information of each sco relative to each student' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_choice_considerations`
-- 

CREATE TABLE IF NOT EXISTS `scorm_choice_considerations` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `preventActivation` varchar(5) NOT NULL default 'false',
  `constrainChoice` varchar(5) NOT NULL default 'false',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='choice_considerations' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_conditions`
-- 

CREATE TABLE IF NOT EXISTS `scorm_conditions` (
  `id` int(11) NOT NULL auto_increment,
  `referencedObjective` varchar(255) character set latin1 default NULL,
  `measureThreshold` varchar(7) character set latin1 default NULL,
  `operator` varchar(4) character set latin1 default 'noOp',
  `ruleCondition` varchar(27) character set latin1 NOT NULL,
  `rule_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_control_modes`
-- 

CREATE TABLE IF NOT EXISTS `scorm_control_modes` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `choiceExit` varchar(5) NOT NULL default 'true',
  `choice` varchar(5) NOT NULL default 'true',
  `flow` varchar(5) NOT NULL default 'false',
  `forwardOnly` varchar(5) NOT NULL default 'false',
  `useCurrentAttemptObjectiveInfo` varchar(5) NOT NULL default 'true',
  `useCurrentAttemptProgressInfo` varchar(5) NOT NULL default 'true',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ControlMode: contenedor de información del sequencing' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_delivery_controls`
-- 

CREATE TABLE IF NOT EXISTS `scorm_delivery_controls` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `tracked` varchar(5) NOT NULL default 'true',
  `completionSetByContent` varchar(5) NOT NULL default 'false',
  `objectiveSetByContent` varchar(5) NOT NULL default 'false',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='DeliveryControl: secuencia que deben seguir las actividades' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_map_infos`
-- 

CREATE TABLE IF NOT EXISTS `scorm_map_infos` (
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
-- Table structure for table `scorm_objectives`
-- 

CREATE TABLE IF NOT EXISTS `scorm_objectives` (
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
-- Table structure for table `scorm_randomizations`
-- 

CREATE TABLE IF NOT EXISTS `scorm_randomizations` (
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
-- Table structure for table `scorm_rollups`
-- 

CREATE TABLE IF NOT EXISTS `scorm_rollups` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `rollupObjectiveSatisfied` varchar(5) default 'true',
  `rollupProgressCompletion` varchar(5) default 'true',
  `objectiveMeasureWeight` varchar(20) default '1.0000',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_rollup_considerations`
-- 

CREATE TABLE IF NOT EXISTS `scorm_rollup_considerations` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) NOT NULL,
  `requiredForSatisfied` varchar(15) NOT NULL default 'always',
  `requiredForNotSatisfied` varchar(15) NOT NULL default 'always',
  `requiredForComplete` varchar(15) NOT NULL default 'always',
  `requiredForIncomplete` varchar(15) NOT NULL default 'always',
  `measureSatisfactionIfActive` varchar(5) NOT NULL default 'true',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='RollupConsideration:indican cuándo una actividad debe ser i' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_rules`
-- 

CREATE TABLE IF NOT EXISTS `scorm_rules` (
  `id` int(11) NOT NULL auto_increment,
  `sco_id` int(11) default NULL,
  `type` varchar(4) default NULL,
  `conditionCombination` varchar(3) default 'all',
  `action` varchar(20) default NULL,
  `minimumPercent` varchar(6) default '0.0000',
  `minimumCount` varchar(5) default '0',
  `rollup_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_schema_info`
-- 

CREATE TABLE IF NOT EXISTS `scorm_schema_info` (
  `version` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_scorms`
-- 

CREATE TABLE IF NOT EXISTS `scorm_scorms` (
  `id` int(11) unsigned NOT NULL auto_increment COMMENT 'primary key',
  `course_id` int(11) NOT NULL COMMENT 'foreign key to course',
  `name` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'name for scorm asset',
  `file_name` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'file name of scorm package',
  `description` text collate utf8_unicode_ci NOT NULL COMMENT 'description of scorm asset',
  `version` varchar(9) collate utf8_unicode_ci NOT NULL COMMENT 'scorm version',
  `created` datetime NOT NULL COMMENT 'created time',
  `modified` datetime NOT NULL COMMENT 'modified time',
  `hash` varchar(35) collate utf8_unicode_ci NOT NULL COMMENT 'hash sum of file reference',
  `path` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents a scorm asset in a course' AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_scos`
-- 

CREATE TABLE IF NOT EXISTS `scorm_scos` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds each SCO from a SCORM package' AUTO_INCREMENT=325 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `scorm_sco_presentations`
-- 

CREATE TABLE IF NOT EXISTS `scorm_sco_presentations` (
  `id` int(11) NOT NULL auto_increment,
  `hideKey` varchar(10) NOT NULL,
  `sco_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='SCOPresentation: información de la presentación de una act' AUTO_INCREMENT=1 ;

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
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

