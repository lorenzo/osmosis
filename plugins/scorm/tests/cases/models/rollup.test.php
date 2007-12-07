<?php 

App::import('Model', 'scorm.Rollup');
App::import('Model', 'scorm.Rule');
App::import('Model', 'scorm.Condition');

class RollupTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('rollup','rule','condition');

	function setUp() {
		$this->TestObject = new Rollup();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->Rule->useDbConfig = 'test_suite';
		$this->TestObject->Rule->tablePrefix = 'test_suite_';
		$this->TestObject->Rule->Condition->useDbConfig = 'test_suite';
		$this->TestObject->Rule->Condition->tablePrefix = 'test_suite_';
	
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
	
	function testCRUD() {
		// Insert a new Condition
		$data = array (
			'rollupObjectiveSatisfied' => 'false',
			'rollupProgressCompletion' => 'false',
			'objectiveMeasureWeight' => '0.9931'
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		
		// Update the inserted Condition and Read
		$data = array (
			'rollupObjectiveSatisfied' => 'true',
			'rollupProgressCompletion' => 'true',
			'objectiveMeasureWeight' => '1.0000',
			'sco_id' => 1
		);
		$this->TestObject->save($data);
		$this->assertEqual(2, $this->TestObject->findCount());
		$last_id = $this->TestObject->getLastInsertID();
		$this->TestObject->id = $last_id;
		$expectedData = array(
			'Rollup' => Set::merge(
				$data,
				array('id' => $last_id) 
			),
			'Rule' => array()
		);
		$this->assertEqual($expectedData, $this->TestObject->read());

		// Delete
		$this->TestObject->delete();
		$this->assertEqual(1, $this->TestObject->findCount());
	}
	
	function testSave() {
		$data = array (
			'rollupObjectiveSatisfied' => 'false',
			'rollupProgressCompletion' => 'false',
			'objectiveMeasureWeight' => '0.9931'
		);
		$data['Rule'][] = array(
			'Condition' =>array( array('condition'=>'completed')),
			'Action' => array('action'=>'satisfied')
		);
		$this->TestObject->save($data);
		$this->assertEqual(2,$this->TestObject->findCount());
		$this->assertEqual(1,$this->TestObject->Rule->findCount(array('rollup_id'=>$this->TestObject->getLastInsertID())));
		$this->assertEqual(1,$this->TestObject->Rule->Condition->findCount(array('rule_id'=>$this->TestObject->Rule->getLastInsertID())));
	}

}
?>
