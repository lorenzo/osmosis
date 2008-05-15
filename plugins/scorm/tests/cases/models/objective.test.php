<?php 

App::import('Model', 'scorm.Objective');

class TestObjective extends Objective {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class ObjectiveTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.objective','plugin.scorm.map_info');

	function start() {
		parent::start();
		$this->TestObject = new TestObjective();
		$this->TestObject->MapInfo->useDbConfig = 'test';
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'Objective'));
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
	
	function testSave3() {
		$data = array();
		$data['Objective'] = array(
    		'objectiveID'			=> 'FAADAS-GDFGDFGF',
    		'sco_id'				=> 1,
    		'satisfiedByMeasure'	=> 'true',
    		'minNormalizedMeasure'	=> '0.6'
		);
		$data['MapInfo'] = array(
    		'targetObjectiveID'		=> 'SADASFA-FSDADSASD',
    		'readSatisfiedStatus'	=> 'true',
    		'readNormalizedMeasure'	=> 'false',
    		'writeSatisfiedStatus'	=> 'false',
    		'writeNormalizedMeasure'=> 'true'
		);
		$this->TestObject->save($data);
		$id = $this->TestObject->getLastInsertId();
		$data['Objective']['id'] = $id;
		$data['Objective']['primary'] = 0;
		$data['MapInfo']['objective_id'] = $id;
		$data['MapInfo']['id'] =  $this->TestObject->MapInfo->getLastInsertId();
		$this->assertEqual($data,$this->TestObject->findById($id));
	}
}
?>
