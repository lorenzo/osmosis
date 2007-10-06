<?php 

loadModel('scorm.Objective');

class ObjectiveTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('sco','objective','map_info');

	function setUp() {
		$this->TestObject = new Objective();
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
		$expectedErrors = array(
    		'objectiveID'		=> 'scormplugin.objective.objectiveid.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$data = array(
    		'objectiveID'		=> '',
    		'satisfiedByMeasure'	=> 'nope',
    		'minNormalizedMeasure'	=> 'true'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'objectiveID'			=> 'scormplugin.objective.objectiveid.empty',
    		'satisfiedByMeasure'	=> 'scormplugin.objective.satisfiedbymeasure.boolean',
    		'minNormalizedMeasure'	=> 'scormplugin.objective.minnormalizedmeasure.decimal'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
    		'objectiveID'		=> 'FAADAS-GDFGDFGF',
    		'satisfiedByMeasure'	=> 'true',
    		'minNormalizedMeasure'	=> 8.10
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'minNormalizedMeasure'	=> 'scormplugin.objective.minnormalizedmeasure.between'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$data = array(
    		'objectiveID'		=> 'FAADAS-GDFGDFGF',
    		'satisfiedByMeasure'	=> 'true',
    		'minNormalizedMeasure'	=> -1.5
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'minNormalizedMeasure'	=> 'scormplugin.objective.minnormalizedmeasure.between'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data = array(
    		'objectiveID'			=> 'FAADAS-GDFGDFGF',
    		'sco_id'				=> 1,
    		'satisfiedByMeasure'	=> 'true',
    		'minNormalizedMeasure'	=> '0.6'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
	}
	
	function testSave2() {
		$data = array();
		$this->TestObject->save($data);
		$this->assertEqual(1,$this->TestObject->findCount());
	}
}
?>