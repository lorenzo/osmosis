<?php 

App::import('Model', 'scorm.MapInfo');

class TestMapInfo extends MapInfo {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class MapInfoTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.map_info');

	function start() {
		parent::start();
		$this->TestObject = new TestMapInfo();
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'MapInfo'));
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
		$data['MapInfo'] = array(
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
