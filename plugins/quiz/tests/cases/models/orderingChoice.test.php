<?php 

App::import('model', 'quiz.OrderingChoice');

class OrderingChoiceTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new OrderingChoice();
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