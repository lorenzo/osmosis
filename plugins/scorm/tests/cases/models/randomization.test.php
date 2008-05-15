<?php 

App::import('Model', 'scorm.Randomization');

class TestRandomization extends Randomization {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class RandomizationTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.randomization');

	function start() {
		parent::start();
		$this->TestObject = new TestRandomization();
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'Randomization'));
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
    		'randomizationTiming'	=> 'once',
    		'selectCount'			=> '12',
    		'reorderChildren'		=> 'true',
    		'selectionTiming'		=> 'onEachNewAttempt'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
    		'randomizationTiming'	=> 'always',
    		'selectCount'			=> 'abc',
    		'reorderChildren'		=> 'no',
    		'selectionTiming'		=> 'a few times'
		);
		$this->TestObject->set($data);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
    		'randomizationTiming'	=> 'scormplugin.randomization.randomizationtiming.token',
    		'selectCount'			=> 'scormplugin.randomization.selectcount.integer',
    		'reorderChildren'		=> 'scormplugin.randomization.reorderchildren.empty',
    		'selectionTiming'		=> 'scormplugin.randomization.selectiontiming.token'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data = array(
    		'randomizationTiming'	=> 'never',
    		'selectCount'			=> '12',
    		'reorderChildren'		=> 'false',
    		'selectionTiming'		=> 'never'
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
