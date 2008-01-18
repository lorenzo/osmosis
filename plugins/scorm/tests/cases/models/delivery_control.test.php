<?php
App::import('Model', 'scorm.DeliveryControl');

class DeliveryControlTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('delivery_control');

	function setUp() {
		$this->TestObject = new DeliveryControl();
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
			'DeliveryControl' => array(
				'tracked'					=> 'yes',
				'completionSetByContent'	=> 'nope',
				'objectiveSetByContent'		=> 'yes'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'tracked'					=> 'scormplugin.deliverycontrol.tracked.boolean',
			'completionSetByContent'	=> 'scormplugin.deliverycontrol.completionsetbycontent.boolean',
			'objectiveSetByContent'		=> 'scormplugin.deliverycontrol.objectivesetbycontent.boolean'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$data = array(
			'DeliveryControl' => array(
				'tracked'					=> 'true',
				'completionSetByContent'	=> 'true',
				'objectiveSetByContent'		=> 'true'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$data = array(
			'DeliveryControl' => array(
				'tracked'					=> 'false',
				'completionSetByContent'	=> 'false',
				'objectiveSetByContent'		=> 'false'
			)
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data = array(
    		'DeliveryControl' => array(
				'tracked'					=> 'true',
				'completionSetByContent'	=> 'false',
				'objectiveSetByContent'		=> 'false'
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
