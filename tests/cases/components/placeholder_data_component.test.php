<?php
/**
 * Test order is important.
 */
App::import('Component','PlaceholderData');
App::import('Controller','AppController');

class DummyComponent extends PlaceHolderDataComponent {
	var $name = 'Dummy';
	var $types = array('menu');
	var $auto = true;
	
	function getData($type = null) {
		return array('var' => 'value');
	}
}

class PlaceHolderDataComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	
	function setUp() {
		$this->TestObject = new DummyComponent();
		$this->TestObject->startup(new Controller);
	}
	
	function testSetData() {
		$this->assertTrue(is_a($this->TestObject->controller,'Controller'));
		$expected = array('placeholders' => array('menu' => array('Dummy' => array('cache'=>'+1 hour','data'=>array('var' => 'value')))));
		$this->assertEqual($this->TestObject->controller->viewVars,$expected);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
}
?>
