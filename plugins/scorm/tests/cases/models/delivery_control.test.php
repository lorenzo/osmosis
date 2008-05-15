<?php
App::import('Model', 'scorm.DeliveryControl');

class TestDeliveryControl extends DeliveryControl {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class DeliveryControlTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin.scorm.delivery_control');

	function start() {
		parent::start();
		$this->TestObject = new TestDeliveryControl();
	}
	
	function testInstance() {
		$this->assertTrue(is_a($this->TestObject,'DeliveryControl'));
	}
	
	function testValidation1() {
		$data = array();
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
		$this->TestObject->set($data);
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
