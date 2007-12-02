<?php 

App::import('Controller', 'Wikis');

class WikisControllerTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new WikisController();
	}

	function tearDown() {
		unset($this->TestObject);
	}

	/*
	function testMe() {
		$result = $this->TestObject->index();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>