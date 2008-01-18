<?php 
App::import('Model', 'quiz.Quiz');

class QuizTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('quiz', 'association_question','qas');

	function setUp() {
		$this->TestObject = new Quiz();
		$this->TestObject->useDbConfig = 'test';
		$this->TestObject->Qas->useDbConfig = 'test';
		$this->TestObject->AssociationQuestion->useDbConfig = 'test';
		$this->TestObject->Quiz->useDbConfig = 'test';
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
		$this->TestObject->create();
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
		$last_id = $this->TestObject->getLastInsertId();
		$data['Quiz']['id'] = $last_id;
		$quiz = $this->TestObject->find(
				'first',
				array(
					'conditions' => array('id' => $last_id),
					'recursive' => -1
				)
		);
		$this->assertEqual($data, $quiz);
		
		$this->TestObject->Qas->save(
			array(
				'Qas' => array(
					'quiz_id' => $last_id,
					'association_question_id' => 'aq_from_fixture1'
				)
			)
		);
		$quiz = $this->TestObject->find(
				'first',
				array(
					'conditions' => array('id' => $last_id)
				)
		);
		
		$quiz_aqs = $quiz['AssociationQuestion'];
		unset($quiz_aqs[0]['Qas']['id']);
		
		$expected_aqs = array(
		    array(
		        'id' => 'aq_from_fixture1',
	            'body' => 'fisico',
	            'shuffle' => '0',
	            'max_associations' => '0',
	            'min_associations' => '',
	            'Qas' => array(
	                    'association_question_id' => 'aq_from_fixture1',
	                    'quiz_id' => $last_id
                )
			)
		);
		$this->assertEqual($quiz_aqs, $expected_aqs);
	}
}
?>
