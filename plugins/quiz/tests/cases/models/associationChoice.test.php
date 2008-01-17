<?php 

App::import('model', 'quiz.AssociationChoice');

class AssociationChoiceTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new AssociationChoice();
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