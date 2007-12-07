<?php
App::import('Model', 'scorm.ScoPresentation');

class ScoPresentationTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('sco_presentation');

	function setUp() {
		$this->TestObject = new ScoPresentation();
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
			'ScoPresentation' => array(
				'hideKey'	=> 'yes',
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'hideKey'			=> 'scormplugin.scopresentation.hidekey.token',
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$token = array ('previous', 'continue', 'exit', 'exitAll','abandon','abandonAll','suspendAll');
		foreach ($token as &$value){
		$this->TestObject->create();
		$data = array(
			'ScoPresentation' => array(
				'hideKey' => $value,
			)
		);
			$this->TestObject->data = $data;
			$valid = $this->TestObject->validates();
			$expectedErrors = array();
			$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
		}		
	}
	function testSave() {
		$data = array(
    		'ScoPresentation' => array(
					'hideKey'=> 'continue',
					)
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
