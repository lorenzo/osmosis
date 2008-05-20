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

/* ChatMessage Test cases generated on: 2008-05-03 12:05:52 : 1209831172*/
App::import('Model', 'Chat.Message');

class TestMessage extends Message {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class MessageTestCase extends CakeTestCase {
	var $Message = null;
	var $fixtures = array('plugin.chat.message', 'app.member');

	function start() {
		parent::start();
		$this->Message = new TestMessage();
	}

	function testMessageInstance() {
		$this->assertTrue(is_a($this->Message, 'Message'));
	}

	function testChatMessageFind() {
		$results = $this->Message->recursive = -1;
		$results = $this->Message->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Message' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'sender_id'  => 1,
			'receiver_id'  => 1,
			'room_id'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2008-05-03 12:12:52',
			'text'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>
