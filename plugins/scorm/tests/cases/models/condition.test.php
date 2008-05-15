<?php 

App::import('Model', 'scorm.Condition');

class TestCondition extends Condition {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class ConditionTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.condition');

	function start() {
		parent::start();
		$this->TestObject = new TestCondition();
		$this->TestObject->Rule->useDbConfig = 'test';
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'Condition'));
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$data = array(
			'measureThreshold' => '-1.01',
			'operator' => 'bubby',
			'ruleCondition' => 'greatWork'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'measureThreshold' => 'scorm.condition.measurethreshold.range',
			'operator' => 'scorm.condition.operator.token',
			'ruleCondition' => 'scorm.condition.condition.token'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
			'measureThreshold' => '1.01',
			'operator' => 'noOp'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'ruleCondition'	=> 'scorm.condition.condition.token',
			'measureThreshold' => 'scorm.condition.measurethreshold.range',
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$allowedConditions = array(
			'satisfied',
			'objectiveStatusKnown',
			'objectiveMeasureKnown',
			'objectiveMeasureGreaterThan',
			'objectiveMeasureLessThan',
			'completed',
			'activityProgressKnown',
			'attempted',
			'attemptLimitExceeded',
			'timeLimitExceeded',
			'outsideAvailableTimeRange',
			'always'
		);
		foreach($allowedConditions as $allowedCondition) {
			$data = array(
				'measureThreshold' => '0.0010',
				'operator' => 'not',
				'ruleCondition' => $allowedCondition
			);
			$this->TestObject->create();
			$this->TestObject->set($data);
			$valid = $this->TestObject->validates();
			$expectedErrors = array();
			$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
		}
	}
	
	function testCRUD() {
		// Insert a new Condition
		$data = array (
			'referencedObjective' => 'HOLA1',
			'measureThreshold' => '0.0100',
			'operator' => 'not',
			'ruleCondition' => 'activityProgressKnown'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		
		// Update the inserted Condition and Read
		$data = array (
			'referencedObjective' => 'HOLA_UPDATE',
			'measureThreshold' => '0.0100',
			'operator' => 'noOp',
			'ruleCondition' => 'activityProgressKnown'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		$last_id = $this->TestObject->getLastInsertID();
		$this->TestObject->id = $last_id;
		$expectedData = array(
			'Condition' => Set::merge(
				$data,
				array('id' => $last_id, 'rule_id' => '') 
			),
			'Rule' => array()
		);
		$this->assertEqual($expectedData, $this->TestObject->read());
		
		// Delete
		$this->TestObject->delete();
		$this->assertEqual(1, $this->TestObject->findCount());
	}
}
?>
