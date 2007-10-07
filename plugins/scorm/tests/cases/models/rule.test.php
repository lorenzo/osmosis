<?php 

loadModel('scorm.Rule');
loadModel('scorm.Rollup');
loadModel('scorm.Condition');

class RuleTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Rule();
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'type' => 'scorm.rule.type.allowedvalues',
			'action' => 'scorm.rule.action.allowedvalues'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation2() {
		$allowedActions = array (
			'pre' => array(skip,disabled,hiddenFromChoice,stopForwardTraversal),
			'post' => array(exitParent,exitAll,retry,retryAll,continue,previous),
			'exit' => array(exit),
			'rollup' => array(satisfied,notSatisfied,completed,incomplete)
		);
		$data = array(
			'Rule' => array(
				'type' => 'pre',
				'conditionCombination' => 'all',
				'action' => ''
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'type' => 'scorm.rule.type.allowedvalues',
			'action' => 'scorm.rule.action.allowedvalues'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
}
?>
