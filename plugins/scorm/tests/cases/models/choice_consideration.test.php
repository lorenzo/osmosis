<?php 

App::import('Model', 'scorm.ChoiceConsideration');

class ChoiceConsiderationTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('choice_consideration');

	function setUp() {
		$this->TestObject = new ChoiceConsideration();
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
			'ChoiceConsideration' => array(
				'preventActivation'		=> 'yes',
				'constrainChoice'		=> 'nope'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'preventActivation'		=> 'scormplugin.choiseconsideration.preventactivation.boolean',
			'constrainChoice'		=> 'scormplugin.choiseconsideration.constrainchoice.boolean'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
			'ChoiceConsideration' => array(
				'preventActivation'		=> 'true',
				'constrainChoice'		=> 'true'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$data = array(
			'ChoiceConsideration' => array(
				'preventActivation'		=> 'false',
				'constrainChoice'		=> 'false'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data = array(
    		'ChoiceConsideration' => array(
				'preventActivation'		=> 'false',
				'constrainChoice'		=> 'false'
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
