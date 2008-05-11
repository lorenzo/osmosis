<?php 
/* SVN FILE: $Id$ */
/* ChatMessagesController Test cases generated on: 2008-05-03 12:05:58 : 1209832378*/
App::import('Controller', 'Chat.ChatMessages');

class TestChatMessages extends ChatMessagesController {
	var $autoRender = false;
}

class ChatMessagesControllerTest extends CakeTestCase {
	var $ChatMessages = null;

	function setUp() {
		$this->ChatMessages = new TestChatMessages();
	}

	function testChatMessagesControllerInstance() {
		$this->assertTrue(is_a($this->ChatMessages, 'ChatMessagesController'));
	}

	function tearDown() {
		unset($this->ChatMessages);
	}
}
?>