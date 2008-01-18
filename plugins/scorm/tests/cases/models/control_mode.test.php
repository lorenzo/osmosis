<?php
App::import('Model', 'scorm.ControlMode');

class ControlModeTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('control_mode');

	function setUp() {
		$this->TestObject = new ControlMode();
		$this->TestObject->useDbConfig = 'test';
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
			'ControlMode' => array(
				'choiceExit'						=> 'yes',
				'choice'							=> 'nope',
				'flow'								=> 'yes',
				'forwardOnly'						=> 'nope',
				'useCurrentAttemptObjectiveInfo'	=> 'yes',
				'useCurrentAttemptProgressInfo'		=> 'nope'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'choiceExit'						=> 'scormplugin.controlmode.choiceexit.boolean',
			'choice'							=> 'scormplugin.controlmode.choice.boolean',
			'flow'								=> 'scormplugin.controlmode.flow.boolean',
			'forwardOnly'						=> 'scormplugin.controlmode.forwardonly.boolean',
			'useCurrentAttemptObjectiveInfo'	=> 'scormplugin.controlmode.usecurrentattemptobjectiveinfo.boolean',
			'useCurrentAttemptProgressInfo'		=> 'scormplugin.controlmode.usecurrentattemptprogressinfo.boolean'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testValidation3() {
		$data = array(
			'ControlMode' => array(
				'choiceExit'						=> 'true',
				'choice'							=> 'true',
				'flow'								=> 'true',
				'forwardOnly'						=> 'true',
				'useCurrentAttemptObjectiveInfo'	=> 'true',
				'useCurrentAttemptProgressInfo'		=> 'true'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$data = array(
			'ControlMode' => array(
				'choiceExit'						=> 'false',
				'choice'							=> 'false',
				'flow'								=> 'false',
				'forwardOnly'						=> 'false',
				'useCurrentAttemptObjectiveInfo'	=> 'false',
				'useCurrentAttemptProgressInfo'		=> 'false'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testSave() {
		$data = array(
    		'ControlMode' => array(
				'choiceExit'						=> 'true',
				'choice'							=> 'true',
				'flow'								=> 'false',
				'forwardOnly'						=> 'false',
				'useCurrentAttemptObjectiveInfo'	=> 'true',
				'useCurrentAttemptProgressInfo'		=> 'true'
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
