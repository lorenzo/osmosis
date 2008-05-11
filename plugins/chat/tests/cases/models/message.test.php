<?php 
/* SVN FILE: $Id$ */
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