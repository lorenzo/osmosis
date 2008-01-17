<?php 

App::import('model', 'quiz.ChoiceChoice');

class ChoiceChoiceTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new ChoiceChoice();
	}

	function tearDown() {
		unset($this->TestObject);
	}

	/*
	function testMe() {
		$result = $this->TestObject->findAll();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>