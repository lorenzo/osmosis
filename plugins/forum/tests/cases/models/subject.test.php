<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3

/* Topic Test cases generated on: 2008-02-02 14:02:10 : 1201975390*/
App::import('Model', 'Topic');

class TestTopic extends Topic {
	var $cacheSources = false;
}

class TopicTestCase extends CakeTestCase {
	var $Topic = null;
	var $fixtures = array('app.topic', 'app.forum', 'app.member', 'app.discussion');

	function start() {
		parent::start();
		$this->Topic = new TestTopic();
	}

	function testTopicInstance() {
		$this->assertTrue(is_a($this->Topic, 'Topic'));
	}

	function testTopicFind() {
		$results = $this->Topic->recursive = -1;
		$results = $this->Topic->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Topic' => array(
			'id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'forum_id'  => 1,
			'member_id'  => 1,
			'created'  => '2008-02-02 14:03:10',
			'locked'  => 1,
			'status'  => 'Lorem ipsum dolor '
			));
		$this->assertEqual($results, $expected);
	}
}
?>
