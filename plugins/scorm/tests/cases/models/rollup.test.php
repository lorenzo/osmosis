<?php 

loadModel('scorm.Rollup');
loadModel('scorm.Rule');
loadModel('scorm.Condition');

class RollupTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('rollup');

	function setUp() {
		$this->TestObject = new Rollup();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array ();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation2() {
		$data = array(
			'rollupObjectiveSatisfied' => 'yes',
			'rollupProgressCompletion' => 'niet',
			'objectiveMeasureWeight' => '1'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'rollupObjectiveSatisfied' => 'scorm.rollup.rollupobjectivesatisfied.boolean',
			'rollupProgressCompletion' => 'scorm.rollup.rollupprogresscompletion.boolean',
			'objectiveMeasureWeight' => 'scorm.rule.minimumpercent.decimal'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation3() {
		$data = array(
			'rollupObjectiveSatisfied' => 'true',
			'rollupProgressCompletion' => 'true',
			'objectiveMeasureWeight' => '-0.00001'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'objectiveMeasureWeight' => 'scorm.rule.minimumpercent.range'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation4() {
		$data = array(
			'rollupObjectiveSatisfied' => 'false',
			'rollupProgressCompletion' => 'false',
			'objectiveMeasureWeight' => '1.00001'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array (
			'objectiveMeasureWeight' => 'scorm.rule.minimumpercent.range'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation5() {
		$data = array(
			'objectiveMeasureWeight' => '0.00001'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array ();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

}
?>
