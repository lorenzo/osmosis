<?php 
App::import('Model', 'quiz.AssociationQuestion');
App::import('Model', 'quiz.Quiz');

class AssociationQuestionTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('quiz', 'association_question','qas', 'association_choice');
	
	function setUp() {
		$this->TestObject = new AssociationQuestion();
		$this->TestObject->useDbConfig = 'test';
		$this->TestObject->Quiz->useDbConfig = 'test';
		$this->TestObject->AssociationChoice->useDbConfig = 'test';
		$this->TestObject->Qas->useDbConfig = 'test';
}

	function tearDown() {
		unset($this->TestObject);
	}

	
	function testMe() {
		$result = $this->TestObject->find('all');
		debug($result);
	}
	
}
?>