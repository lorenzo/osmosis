<?php 

App::import('Model', 'quiz.Quiz');

class QuizTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('quiz', 'association_question');

	function setUp() {
		$this->TestObject = new Quiz();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->Qas->useDbConfig = 'test_suite';
		$this->TestObject->Qas->tablePrefix = 'test_suite_';
		$this->TestObject->AssociationQuestion->useDbConfig = 'test_suite';
		$this->TestObject->AssociationQuestion->tablePrefix = 'test_suite_';
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
			'Quiz' => array(
				'name' => 'nuevo quiz'
			)
		);
		
		$this->TestObject->save($data);
		
		$this->TestObject->create();
		$data = array(
			'Quiz' => array(
				'name' => 'otro quiz'
			)
		);
		$this->TestObject->AssociationQuestion->save(
			array(
				'AssociationQuestion' => array(
 					'body' => 'cuerpito'
				)
			)
		);
		
		$this->TestObject->save($data);
		$this->TestObject->Qas->save(
			array(
				'quiz_id' => '1',
				'association_question_id' => '1'
			)
		);
		debug($this->TestObject->AssociationQuestion->find('all'));
		
	}
}
?>
