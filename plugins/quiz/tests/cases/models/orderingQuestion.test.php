<?php 

App::import('model', 'quiz.OrderingQuestion');

class OrderingQuestionTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new OrderingQuestion();
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