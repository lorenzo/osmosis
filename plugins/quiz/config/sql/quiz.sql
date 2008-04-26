-- phpMyAdmin SQL Dump
-- version 2.10.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Apr 26, 2008 at 04:59 PM
-- Server version: 5.0.37
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `osmosis`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `acos`
-- 

CREATE TABLE `acos` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default '',
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default '',
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `acos`
-- 

INSERT INTO `acos` VALUES (1, NULL, NULL, NULL, 'ROOT', 1, 42);
INSERT INTO `acos` VALUES (2, 1, NULL, NULL, 'Controllers/', 2, 41);
INSERT INTO `acos` VALUES (3, 2, NULL, NULL, 'App/', 3, 40);
INSERT INTO `acos` VALUES (4, 3, NULL, NULL, 'Members', 4, 15);
INSERT INTO `acos` VALUES (5, 4, NULL, NULL, 'index', 5, 6);
INSERT INTO `acos` VALUES (6, 4, NULL, NULL, 'view', 7, 8);
INSERT INTO `acos` VALUES (7, 4, NULL, NULL, 'add', 9, 10);
INSERT INTO `acos` VALUES (8, 4, NULL, NULL, 'edit', 11, 12);
INSERT INTO `acos` VALUES (9, 4, NULL, NULL, 'delete', 13, 14);
INSERT INTO `acos` VALUES (10, 3, NULL, NULL, 'Courses', 16, 27);
INSERT INTO `acos` VALUES (11, 10, NULL, NULL, 'index', 17, 18);
INSERT INTO `acos` VALUES (12, 10, NULL, NULL, 'view', 19, 20);
INSERT INTO `acos` VALUES (13, 10, NULL, NULL, 'add', 21, 22);
INSERT INTO `acos` VALUES (14, 10, NULL, NULL, 'edit', 23, 24);
INSERT INTO `acos` VALUES (15, 10, NULL, NULL, 'delete', 25, 26);
INSERT INTO `acos` VALUES (16, 3, NULL, NULL, 'Departments', 28, 39);
INSERT INTO `acos` VALUES (17, 16, NULL, NULL, 'index', 29, 30);
INSERT INTO `acos` VALUES (18, 16, NULL, NULL, 'view', 31, 32);
INSERT INTO `acos` VALUES (19, 16, NULL, NULL, 'add', 33, 34);
INSERT INTO `acos` VALUES (20, 16, NULL, NULL, 'edit', 35, 36);
INSERT INTO `acos` VALUES (21, 16, NULL, NULL, 'delete', 37, 38);

-- --------------------------------------------------------

-- 
-- Table structure for table `aros`
-- 

CREATE TABLE `aros` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default '',
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default '',
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `aros`
-- 

INSERT INTO `aros` VALUES (1, NULL, 'Role', 1, 'Public', 1, 12);
INSERT INTO `aros` VALUES (2, 1, 'Role', 2, 'Member', 2, 11);
INSERT INTO `aros` VALUES (3, 2, 'Role', 3, 'Attendee', 3, 10);
INSERT INTO `aros` VALUES (4, 3, 'Role', 4, 'Helper', 4, 9);
INSERT INTO `aros` VALUES (5, 4, 'Role', 5, 'Instructor', 5, 8);
INSERT INTO `aros` VALUES (6, 5, 'Role', 6, 'Creator', 6, 7);
INSERT INTO `aros` VALUES (7, NULL, 'Role', 7, 'Admin', 13, 16);
INSERT INTO `aros` VALUES (8, 7, 'Member', 1, '', 14, 15);

-- --------------------------------------------------------

-- 
-- Table structure for table `aros_acos`
-- 

CREATE TABLE `aros_acos` (
  `id` int(11) NOT NULL auto_increment,
  `aro_id` int(11) default NULL,
  `aco_id` int(11) default NULL,
  `_create` int(11) NOT NULL default '0',
  `_read` int(11) NOT NULL default '0',
  `_update` int(11) NOT NULL default '0',
  `_delete` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `aros_acos`
-- 

INSERT INTO `aros_acos` VALUES (1, 7, 1, 1, 1, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `courses`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `courses_members`
-- 

CREATE TABLE `courses_members` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `role` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `member_id` (`member_id`,`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `courses_members`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `course_tools`
-- 

CREATE TABLE `course_tools` (
  `id` int(10) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  `plugin_id` smallint(4) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `course_id` (`course_id`,`plugin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Represents the tools that a course has installed';

-- 
-- Dumping data for table `course_tools`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `departments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `members`
-- 

CREATE TABLE `members` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents a registered user';

-- 
-- Dumping data for table `members`
-- 

INSERT INTO `members` VALUES (1, '00-00000', 'Administrator', 'admin@root.com', '000000000', 'Venezuela', 'Caracas', 0, 'M', 7, 'admin', 'e59bd2f67ed4417be8874228b52b66eb8f23fa9d');

-- --------------------------------------------------------

-- 
-- Table structure for table `plugins`
-- 

CREATE TABLE `plugins` (
  `id` smallint(4) unsigned NOT NULL auto_increment,
  `title` varchar(50) collate utf8_unicode_ci default NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` varchar(255) collate utf8_unicode_ci default NULL,
  `author` varchar(100) collate utf8_unicode_ci default NULL,
  `types` varchar(30) collate utf8_unicode_ci NOT NULL default 'tool',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Holds installed plugin names and active status';

-- 
-- Dumping data for table `plugins`
-- 

INSERT INTO `plugins` VALUES (1, 'Quizzes', 1, 'Quiz', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Integer elit sapien, scelerisque vel, euismod vel, faucibus at, dolor. Ut vehicula lorem vel nibh. Nam sed elit id sapien fringilla fermentum. Nam mattis. Proin egestas cursus justo. Nullam et odio', 'Osmosis Team', 'tool');

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_choice_choices`
-- 

CREATE TABLE `quiz_choice_choices` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `choice_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Related Choice Question',
  `text` text NOT NULL COMMENT 'Text for this choce',
  `position` tinyint(3) NOT NULL default '0' COMMENT 'The position of the choice as will appear in the question',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Choice Questions'' choices';

-- 
-- Dumping data for table `quiz_choice_choices`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_choice_questions`
-- 

CREATE TABLE `quiz_choice_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `body` text NOT NULL COMMENT 'The questions wording',
  `shuffle` tinyint(1) NOT NULL COMMENT 'Set the order of the choices randomly',
  `max_choices` int(11) NOT NULL COMMENT 'Maximum number of choices that the candidate is allowed to select. If maxChoices is 0 then there is no restriction. If maxChoices is greater than 1 (or 0) then the interaction must be bound to a response with multiple cardinality',
  `min_choices` int(11) default NULL COMMENT 'Minimum number of choices that the candidate is required to select to form a valid response. If minChoices is 0 then the candidate is not required to select any choices. minChoices must be less than or equal to the limit imposed by maxChoices.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Selection one or more of the available choices';

-- 
-- Dumping data for table `quiz_choice_questions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_choice_questions_quizzes`
-- 

CREATE TABLE `quiz_choice_questions_quizzes` (
  `id` char(36) NOT NULL,
  `choice_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Choice Question with a Quiz (many-to-many)';

-- 
-- Dumping data for table `quiz_choice_questions_quizzes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_cloze_questions`
-- 

CREATE TABLE `quiz_cloze_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'The questions title',
  `body` text NOT NULL COMMENT 'The questions wording',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Embedded Answer Question (Cloze format)';

-- 
-- Dumping data for table `quiz_cloze_questions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_cloze_questions_quizzes`
-- 

CREATE TABLE `quiz_cloze_questions_quizzes` (
  `id` int(11) NOT NULL auto_increment,
  `cloze_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Cloze Question with a Quiz (many-to-many)';

-- 
-- Dumping data for table `quiz_cloze_questions_quizzes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_matching_choices`
-- 

CREATE TABLE `quiz_matching_choices` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `text` text NOT NULL COMMENT 'Text for this choce',
  `matching_question_id` char(36) NOT NULL,
  `target_id` char(36) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Matching Questions'' choices';

-- 
-- Dumping data for table `quiz_matching_choices`
-- 

INSERT INTO `quiz_matching_choices` VALUES ('48137d88-1dd4-40ec-a24c-02c25eb9f4eb', 'lorezo', '48137d88-6f00-428d-9c7a-02c25eb9f4eb', NULL);
INSERT INTO `quiz_matching_choices` VALUES ('48137d88-a7b0-437d-a867-02c25eb9f4eb', 'Mi nombre es', '48137d88-6f00-428d-9c7a-02c25eb9f4eb', '48137d88-1dd4-40ec-a24c-02c25eb9f4eb');
INSERT INTO `quiz_matching_choices` VALUES ('48137d88-5770-49c7-8df7-02c25eb9f4eb', 'joaquin', '48137d88-6f00-428d-9c7a-02c25eb9f4eb', NULL);
INSERT INTO `quiz_matching_choices` VALUES ('48137d88-acf4-4796-afda-02c25eb9f4eb', 'Gaby quiere a', '48137d88-6f00-428d-9c7a-02c25eb9f4eb', '48137d88-5770-49c7-8df7-02c25eb9f4eb');

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_matching_questions`
-- 

CREATE TABLE `quiz_matching_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `body` text NOT NULL COMMENT 'The questions wording',
  `shuffle` tinyint(1) NOT NULL COMMENT 'Set the ordr of the choices randomly',
  `max_associations` tinyint(3) NOT NULL default '0' COMMENT 'Maximum number of choices that the candidate is allowed to select. If maxChoices is 0 then there is no restriction. If maxChoices is greater than 1 (or 0) then the interaction must be bound to a response with multiple cardinality',
  `min_associations` tinyint(3) NOT NULL default '0' COMMENT 'Minimum number of choices that the candidate is required to select to form a valid response. If minChoices is 0 then the candidate is not required to select any choices. minChoices must be less than or equal to the limit imposed by maxChoices.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Matching: Associate pairs of choices from two sets';

-- 
-- Dumping data for table `quiz_matching_questions`
-- 

INSERT INTO `quiz_matching_questions` VALUES ('48137d88-6f00-428d-9c7a-02c25eb9f4eb', 'Hola esto es muy bueno', 1, 9, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_matching_questions_quizzes`
-- 

CREATE TABLE `quiz_matching_questions_quizzes` (
  `id` char(36) NOT NULL,
  `matching_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Matching Question with a Quiz (many-to-many)';

-- 
-- Dumping data for table `quiz_matching_questions_quizzes`
-- 

INSERT INTO `quiz_matching_questions_quizzes` VALUES ('4813737f-7984-452e-82ee-046b5eb9f4eb', '48135d87-fcb0-4820-a044-048e5eb9f4eb', '48123c55-c2bc-473c-8aa5-024f5eb9f4eb');
INSERT INTO `quiz_matching_questions_quizzes` VALUES ('481378e9-1f84-4409-a56c-02c45eb9f4eb', '481378c5-9620-4d6a-9cc0-02c25eb9f4eb', '48123c55-c2bc-473c-8aa5-024f5eb9f4eb');
INSERT INTO `quiz_matching_questions_quizzes` VALUES ('48137da9-149c-49d1-a8c6-027b5eb9f4eb', '48137d88-6f00-428d-9c7a-02c25eb9f4eb', '48123c55-c2bc-473c-8aa5-024f5eb9f4eb');

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_ordering_choices`
-- 

CREATE TABLE `quiz_ordering_choices` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `ordering_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL COMMENT 'Related Choice Question',
  `text` text NOT NULL COMMENT 'Text for this choce',
  `position` tinyint(3) NOT NULL default '0' COMMENT 'The position of the choice as will appear in the question',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Ordering Questions'' choices';

-- 
-- Dumping data for table `quiz_ordering_choices`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_ordering_questions`
-- 

CREATE TABLE `quiz_ordering_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `body` text NOT NULL COMMENT 'The questions wording',
  `shuffle` tinyint(1) NOT NULL COMMENT 'Set the ordr of the choices randomly',
  `max_choices` tinyint(4) NOT NULL default '0' COMMENT 'Maximum number of choices that the candidate is allowed to select. If maxChoices is 0 then there is no restriction. If maxChoices is greater than 1 (or 0) then the interaction must be bound to a response with multiple cardinality',
  `min_choices` tinyint(4) NOT NULL default '0' COMMENT 'Minimum number of choices that the candidate is required to select to form a valid response. If minChoices is 0 then the candidate is not required to select any choices. minChoices must be less than or equal to the limit imposed by maxChoices.',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='The candidate''s task is to select one or more of the choices';

-- 
-- Dumping data for table `quiz_ordering_questions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_ordering_questions_quizzes`
-- 

CREATE TABLE `quiz_ordering_questions_quizzes` (
  `id` char(36) NOT NULL,
  `ordering_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Choice Question with a Quiz (many-to-many)';

-- 
-- Dumping data for table `quiz_ordering_questions_quizzes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_quizzes`
-- 

CREATE TABLE `quiz_quizzes` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'Title of the quiz',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Registered Quizzes';

-- 
-- Dumping data for table `quiz_quizzes`
-- 

INSERT INTO `quiz_quizzes` VALUES ('48123c55-c2bc-473c-8aa5-024f5eb9f4eb', 'Â¿Porque joaquÃ­n cruzÃ³ la callÃ©?');

-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_text_questions`
-- 

CREATE TABLE `quiz_text_questions` (
  `id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'The questions title',
  `body` text NOT NULL COMMENT 'The questions wording',
  `format` varchar(5) NOT NULL COMMENT 'plain, pre or xhtml',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `quiz_text_questions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `quiz_text_questions_quizzes`
-- 

CREATE TABLE `quiz_text_questions_quizzes` (
  `id` char(36) NOT NULL,
  `text_question_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  `quiz_id` char(36) character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `text_question_id` (`text_question_id`,`quiz_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Relates a Text Question with a Quiz (many-to-many)';

-- 
-- Dumping data for table `quiz_text_questions_quizzes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `roles`
-- 

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `role` varchar(10) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Represents groups of users with permissions';

-- 
-- Dumping data for table `roles`
-- 

INSERT INTO `roles` VALUES (1, NULL, 'Public');
INSERT INTO `roles` VALUES (2, 1, 'Member');
INSERT INTO `roles` VALUES (3, 2, 'Attendee');
INSERT INTO `roles` VALUES (4, 3, 'Helper');
INSERT INTO `roles` VALUES (5, 4, 'Instructor');
INSERT INTO `roles` VALUES (6, 5, 'Creator');
INSERT INTO `roles` VALUES (7, NULL, 'Admin');
