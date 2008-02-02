SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- --------------------------------------------------------

-- 
-- Table structure for table `forum_discussions`
-- 

CREATE TABLE IF NOT EXISTS `forum_discussions` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `status` varchar(20) collate utf8_unicode_ci NOT NULL COMMENT 'Describes activity inside subject',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_forums`
-- 

CREATE TABLE IF NOT EXISTS `forum_forums` (
  `id` int(11) NOT NULL auto_increment,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_responses`
-- 

CREATE TABLE IF NOT EXISTS `forum_responses` (
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `discussion_id` char(36) collate utf8_unicode_ci NOT NULL,
  `member_id` int(11) NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `forum_subjects`
-- 

CREATE TABLE IF NOT EXISTS `forum_subjects` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL,
  `forum_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `status` varchar(20) character set utf8 collate utf8_unicode_ci default NULL COMMENT 'Describes activity inside subject',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

