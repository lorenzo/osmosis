<?php 
/* SVN FILE: $Id$ */
/* EventsController Test cases generated on: 2008-05-20 14:05:40 : 1211307100*/
App::import('Controller', 'Agenda.Events');

class TestEvents extends EventsController {
	var $autoRender = false;
}

class EventsControllerTest extends CakeTestCase {
	var $Events = null;

	function setUp() {
		$this->Events = new TestEvents();
	}

	function testEventsControllerInstance() {
		$this->assertTrue(is_a($this->Events, 'EventsController'));
	}

	function tearDown() {
		unset($this->Events);
	}
}
?>