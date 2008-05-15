<?php 

App::import('model', 'quiz.MatchingQuestion');

class TestMatchingQuestion extends MatchingQuestion {
	var $cacheSources = false;
	var $useDbConfig  = 'test';
}

class MatchingQuestionTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array(
		'plugin.quiz.matching_question', 'plugin.quiz.matching_choice',
		'plugin.quiz.matching_question_choices'
	);

	function start() {
		parent::start();
		//$this->TestObject = new MatchingQuestion();
		$this->TestObject->SourceChoice->useDbConfig = 'test';
		$this->TestObject->TargetChoice->useDbConfig = 'test';
		$this->TestObject->MatchingQuestionChoices->useDbConfig = 'test';		
	}

}
?>