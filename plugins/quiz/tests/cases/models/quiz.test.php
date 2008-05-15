<?php 
App::import('Model', 'quiz.Quiz');

class TestQuiz extends Quiz {
	var $cacheSources = false;
	var $useDbConfig  = 'test';
}

class QuizTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array(
		'plugin.quiz.quiz',
		'plugin.quiz.choice_question', 'plugin.quiz.quiz_choice', 'plugin.quiz.quiz_cloze',
		'plugin.quiz.matching_question', 'plugin.quiz.quiz_matching',
		'plugin.quiz.ordering_question', 'plugin.quiz.quiz_ordering',
		'plugin.quiz.text_question', 'plugin.quiz.quiz_text'
	);

	function start() {
		parent::start();
		$this->TestObject = new TestQuiz();
		$this->TestObject->ChoiceQuestion->useDbConfig = 'test';
		$this->TestObject->QuizChoice->useDbConfig = 'test';
		$this->TestObject->ClozeQuestion->useDbConfig = 'test';
		$this->TestObject->MatchingQuestion->useDbConfig = 'test';
		$this->TestObject->QuizMatching->useDbConfig = 'test';
		$this->TestObject->OrderingQuestion->useDbConfig = 'test';
		$this->TestObject->QuizOrdering->useDbConfig = 'test';
		$this->TestObject->TextQuestion->useDbConfig = 'test';
		$this->TestObject->QuizText->useDbConfig = 'test';
	}

	function testValidation() {
		$data = array();
		$this->TestObject->set($data);
		$this->assertEqual(false, $this->TestObject->validates());
		$expected_errors = array(
			'name' => 'quiz.quiz.name.empty'
		);
		$this->assertEqual(array_keys($expected_errors), array_keys($this->TestObject->validationErrors));
		$this->TestObject->create();
		$data = array(
			'name' => ''
		);
		$this->TestObject->set($data);
		$this->assertEqual(false, $this->TestObject->validates());
		$expected_errors = array(
			'name' => 'quiz.quiz.name.empty'
		);
		$this->assertEqual(array_keys($expected_errors), array_keys($this->TestObject->validationErrors));
		$data = array();
	}

	function _insertQuiz () {
		$data = array(
			'Quiz' => array(
				'name' => 'nuevo quiz'
			)
		);
		$this->TestObject->save($data);
		$last_id = $this->TestObject->getLastInsertId();
		return array($data, $last_id);
	}
	function testInsertion() {
		list($data, $last_id) = $this->_insertQuiz();
		$data['Quiz']['id'] = $last_id;
		$quiz = $this->TestObject->find(
				'first',
				array(
					'conditions' => array('id' => $last_id),
					'recursive' => -1
				)
		);
		$this->assertEqual($data, $quiz);
	}
	
	function testChoiceQuestion() {
		list($data, $last_id) = $this->_insertQuiz();
		$this->TestObject->QuizChoice->save(
			array(
				'QuizChoice' => array(
					'quiz_id' => $last_id,
					'choice_question_id' => 'choice_question_fixture_1'
				)
			)
		);
		$quiz = $this->TestObject->find(
				'first',
				array(
					'conditions' => array('id' => $last_id)
				)
		);
		$quiz_chqs = $quiz['ChoiceQuestion'];
		unset($quiz_chqs[0]['QuizChoice']['id']);
		$expected_chqs = array(
		    array(
		        'id' => 'choice_question_fixture_1',
	            'body' => 'this is the question',
	            'shuffle' => '1',
	            'max_choices' => '2',
					'min_choices' => '',
	            'QuizChoice' => array(
	                    'choice_question_id' => 'choice_question_fixture_1',
	                    'quiz_id' => $last_id
                )
			)
		);
		$this->assertEqual($quiz_chqs, $expected_chqs);
	}
	
	function testMatchingQuestion() {
		list($data, $last_id) = $this->_insertQuiz();
		$this->TestObject->QuizMatching->save(
			array(
				'QuizMatching' => array(
					'quiz_id' => $last_id,
					'matching_question_id' => 'matching_from_fixture1'
				)
			)
		);
		
		$quiz = $this->TestObject->find(
				'first',
				array(
					'conditions' => array('id' => $last_id)
				)
		);
		
		$quiz_matchings = $quiz['MatchingQuestion'];
		unset($quiz_matchings[0]['QuizMatching']['id']);
		
		$expected_matchings = array(
			array(
				'id' => 'matching_from_fixture1',
            'body' => 'matching text body',
				'shuffle' => '1',
				'max_associations' => 0,
				'min_associations' => 0,
            'QuizMatching' => array(
					'matching_question_id' => 'matching_from_fixture1',
					'quiz_id' => $last_id
				)
			)
		);
		$this->assertEqual($quiz_matchings, $expected_matchings);
	}
	
	function testOrderingQuestion() {
		list($data, $last_id) = $this->_insertQuiz();
		$this->TestObject->QuizOrdering->save(
			array(
				'QuizOrdering' => array(
					'quiz_id' => $last_id,
					'ordering_question_id' => 'ordering_from_fixture1'
				)
			)
		);
		
		$quiz = $this->TestObject->find(
				'first',
				array(
					'conditions' => array('id' => $last_id)
				)
		);
		$quiz_orderings = $quiz['OrderingQuestion'];
		unset($quiz_orderings[0]['QuizOrdering']['id']);
		
		$expected_orderings = array(
			array(
				'id' => 'ordering_from_fixture1',
            'body' => 'ordering text body',
				'shuffle' => '1',
				'max_choices' => '0',
				'min_choices' => '0',
            'QuizOrdering' => array(
					'ordering_question_id' => 'ordering_from_fixture1',
					'quiz_id' => $last_id
				),
			'OrderingChoice' => array()
			)
		);
		$this->assertEqual($quiz_orderings, $expected_orderings);
	}
	
	function testTextQuestion() {
		list($data, $last_id) = $this->_insertQuiz();
		$this->TestObject->QuizText->save(
			array(
				'QuizText' => array(
					'quiz_id' => $last_id,
					'text_question_id' => 'text_from_fixture1'
				)
			)
		);
		
		$quiz = $this->TestObject->find(
				'first',
				array(
					'conditions' => array('id' => $last_id)
				)
		);
		$quiz_texts = $quiz['TextQuestion'];
		unset($quiz_texts[0]['QuizText']['id']);
		
		$expected_texts = array(
			array(
				'id' => 'text_from_fixture1',
            'body' => 'Text Question Body',
				'title'	=> 'Text Question Title',
				'format' => 'xhtml',
            'QuizText' => array(
					'text_question_id' => 'text_from_fixture1',
					'quiz_id' => $last_id
				)
			)
		);
		
		$this->assertEqual($quiz_texts, $expected_texts);
	}
	
}
?>
