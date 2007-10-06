<?php 

loadModel('scorm.MapInfo');

class MapInfoTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('objective','map_info');

	function setUp() {
		$this->TestObject = new MapInfo();
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
    		'targetObjectiveID'		=> 'scormplugin.mapinfo.targetobjectiveid.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$data = array(
    		'targetObjectiveID'		=> 'SADASdsafFA-FSDADSASD',
    		'readSatisfiedStatus'	=> 'false',
    		'readNormalizedMeasure'	=> 'true',
    		'writeSatisfiedStatus'	=> 'true',
    		'writeNormalizedMeasure'=> 'false'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
    		'targetObjectiveID'		=> '',
    		'readSatisfiedStatus'	=> 'yes',
    		'readNormalizedMeasure'	=> 'no',
    		'writeSatisfiedStatus'	=> 'ok',
    		'writeNormalizedMeasure'=> 'maybe'
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'targetObjectiveID'		=> 'scormplugin.mapinfo.targetobjectiveid.empty',
    		'readSatisfiedStatus'	=> 'scormplugin.mapinfo.readsatisfiedstatus.boolean',
    		'readNormalizedMeasure'	=> 'scormplugin.mapinfo.readnormalizedmeasure.boolean',
    		'writeSatisfiedStatus'	=> 'scormplugin.mapinfo.writesatisfiedstatus.boolean',
    		'writeNormalizedMeasure'=> 'scormplugin.mapinfo.writenormalizedmeasure.boolean'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data = array(
			'objective_id'			=> 1,
    		'targetObjectiveID'		=> 'SADASdsafFA-FSDADSASD',
    		'readSatisfiedStatus'	=> 'false',
    		'readNormalizedMeasure'	=> 'true',
    		'writeSatisfiedStatus'	=> 'true',
    		'writeNormalizedMeasure'=> 'false'
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