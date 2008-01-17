<?php 

App::import('Model', 'quiz.Quiz');

class QuizTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('quiz');

	function setUp() {
		$this->TestObject = new Quiz();
		$this->TestObject->useDbConfig = 'test_suite';
		//$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation() {
		$data = array();
		$this->TestObject->set($data);
		$this->assertEqual(false, $this->TestObject->validates());
		$expected_errors = array(
			'name' => 'quiz.quiz.name.empty'
		);
		$this->assertEqual($expected_errors, $this->TestObject->validationErrors);
	}
	
	function test2() {
		$data = array(
			'name' => ''
		);
		$this->TestObject->set($data);
		$this->assertEqual(false, $this->TestObject->validates());
		$expected_errors = array(
			'name' => 'quiz.quiz.name.empty'
		);
		$this->assertEqual($expected_errors, $this->TestObject->validationErrors);
		$data = array();
	}
	
	function testInsertion() {
		$data = array(
			'name' => 'quiz1'
		);
		
		$this->TestObject->save($data);
		debug($this->TestObject->find('all'));
	}
}
?>
