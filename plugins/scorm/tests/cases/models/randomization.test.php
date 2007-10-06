<?php 

loadModel('scorm.Randomization');

class RandomizationTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('randomization');

	function setUp() {
		$this->TestObject = new Randomization();
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
		$this->TestObject->data = $data;
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
		$this->TestObject->data = $data;
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