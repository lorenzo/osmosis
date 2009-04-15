-- 
-- Table structure for table `chat_members_rooms`
-- 

CREATE TABLE `chat_members_rooms` (
  `id` char(36) character set ascii NOT NULL,
  `member_id` int(10) NOT NULL,
  `room_id` char(36) character set ascii NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `chat_messages`
-- 

CREATE TABLE `chat_messages` (
  `id` char(36) character set ascii NOT NULL,
  `sender_id` int(10) NOT NULL,
  `receiver_id` int(10) default NULL,
  `room_id` char(36) character set ascii NOT NULL,
  `created` int(11) unsigned NOT NULL,
  `text` tinytext collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

-- 
-- Table structure for table `chat_rooms`
-- 

CREATE TABLE `chat_rooms` (
  `id` char(36) character set ascii NOT NULL,
  `course_id` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;