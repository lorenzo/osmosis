<?php 

App::import('model', 'quiz.MatchingChoice');

class MatchingChoiceTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new MatchingChoice();
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