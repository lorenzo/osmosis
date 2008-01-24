<?php 

App::import('model', 'quiz.MatchingQuestion');

class MatchingQuestionTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array(
		'matching_question', 'matching_choice',
		'matching_question_choices'
	);

	function setUp() {
		$this->TestObject = new MatchingQuestion();
		$this->TestObject->useDbConfig = 'test';
		$this->TestObject->SourceChoice->useDbConfig = 'test';
		$this->TestObject->TargetChoice->useDbConfig = 'test';
		$this->TestObject->MatchingQuestionChoices->useDbConfig = 'test';		
	}

	function tearDown() {
		unset($this->TestObject);
	}

	
	function test1to1() {
		$matching_question = $this->TestObject->find();
	}	
}
?>