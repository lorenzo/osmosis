-- --------------------------------------------------------

-- 
-- Table structure for table `acos`
-- 

DROP TABLE IF EXISTS `acos`;
CREATE TABLE `acos` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `aros`
-- 

DROP TABLE IF EXISTS `aros`;
CREATE TABLE `aros` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `model` varchar(255) default NULL,
  `foreign_key` int(11) default NULL,
  `alias` varchar(255) default NULL,
  `lft` int(11) default NULL,
  `rght` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `aros_acos`
-- 

DROP TABLE IF EXISTS `aros_acos`;
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

-- --------------------------------------------------------

-- 
-- Table structure for table `courses`
-- 

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL auto_increment,
  `owner_id` int(11) NOT NULL,
  `department_id` int(4) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `courses_members`
-- 

DROP TABLE IF EXISTS `courses_members`;
CREATE TABLE `courses_members` (
  `id` varchar(36) NOT NULL,
  `member_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `member_id` (`member_id`,`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `course_tools`
-- 

DROP TABLE IF EXISTS `course_tools`;
CREATE TABLE `course_tools` (
  `id` int(10) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  `plugin_id` int(4) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `course_id` (`course_id`,`plugin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `departments`
-- 

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `members`
-- 

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL auto_increment,
  `institution_id` varchar(20) default NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) default NULL,
  `country` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `age` int(2) NOT NULL,
  `sex` varchar(1) NOT NULL default 'M',
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_seen` int(11) NOT NULL,
  `admin` tinyint(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `model_logs`
-- 

DROP TABLE IF EXISTS `model_logs`;
CREATE TABLE `model_logs` (
  `id` int(11) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `model` varchar(50) NOT NULL,
  `entity_id` varchar(36) NOT NULL,
  `created` tinyint(1) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `plugins`
-- 

DROP TABLE IF EXISTS `plugins`;
CREATE TABLE `plugins` (
  `id` int(4) NOT NULL auto_increment,
  `title` varchar(50) default NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) default NULL,
  `author` varchar(100) default NULL,
  `types` varchar(30) NOT NULL default 'tool',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `roles`
-- 

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Table structure for table `tags`
-- 

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
