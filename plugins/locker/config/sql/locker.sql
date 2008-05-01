-- Generation Time: May 01, 2008 at 05:53 PM
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- --------------------------------------------------------

-- 
-- Table structure for table `locker_documents`
-- 

CREATE TABLE `locker_documents` (
  `id` char(36) character set ascii NOT NULL COMMENT 'document id',
  `name` varchar(100) collate utf8_unicode_ci NOT NULL COMMENT 'The name of the document',
  `description` text collate utf8_unicode_ci NOT NULL COMMENT 'document''s description',
  `file_name` varchar(150) collate utf8_unicode_ci NOT NULL COMMENT 'Original file name',
  `type` varchar(50) character set ascii NOT NULL default 'application/octet-stream' COMMENT 'File mime-type',
  `size` int(10) NOT NULL COMMENT 'Size of file in bytes',
  `member_id` int(11) NOT NULL COMMENT 'locker''s id in which the document resides',
  `folder_id` char(36) collate utf8_unicode_ci default NULL COMMENT 'Foreing key to directories table',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Documents in a locker';

-- --------------------------------------------------------

-- 
-- Table structure for table `locker_folders`
-- 

CREATE TABLE `locker_folders` (
  `id` char(36) character set ascii NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `folder_name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `parent_id` char(36) collate utf8_unicode_ci default NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
