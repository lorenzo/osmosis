<?php 

App::import('model', 'quiz.ChoiceQuestion');

class ChoiceQuestionTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new ChoiceQuestion();
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