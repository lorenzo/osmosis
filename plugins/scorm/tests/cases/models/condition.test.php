<?php 

loadModel('scorm.Condition');
loadModel('scorm.Rule');
loadModel('scorm.Rollup');

class ConditionTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('condition');

	function setUp() {
		$this->TestObject = new Condition();
		$this->TestObject->useDbConfig = 'test';
		$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$data = array(
			'measureThreshold' => '-1.01',
			'operator' => 'bubby',
			'condition' => 'greatWork'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'measureThreshold' => 'scorm.condition.measurethreshold.range',
			'operator' => 'scorm.condition.operator.token',
			'condition' => 'scorm.condition.condition.token'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
			'measureThreshold' => '1.01',
			'operator' => 'noOp'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
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
				'condition' => $allowedCondition
			);
			$this->TestObject->create();
			$this->TestObject->data = $data;
			$valid = $this->TestObject->validates();
			$expectedErrors = array();
			$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
		}
	}
	
	function testSave() {
		$data = array (
			'referencedObjective' => 'HOLA1',
			'measureThreshold' => '0.0100',
			'operator' => 'not',
			'condition' => 'activityProgressKnown'
		);
		var_dump($this->TestObject->save($data));
		$this->assertEqual(2, $this->TestObject->findCount());
	}
}
?>
