<?php
/**
 * Test order is important.
 */
App::import('Component','PlaceholderData');
App::import('Controller','AppController');

class DummyComponent extends PlaceHolderDataComponent {
	var $name = 'Dummy';
	var $type = 'menu';
	var $auto = true;
	
	function getData() {
		return array('var' => 'value');
	}
}

class PlaceHolderDataComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	
	function setUp() {
		$this->TestObject = new DummyComponent();
		$this->TestObject->startup(new AppController);
	}
	
	function testSetData() {
		$this->assertTrue(is_a($this->TestObject->controller,'AppController'));
		$expected = array('placeholders' => array('menu' => array('Dummy' => array('cache'=>'+1 hour','data'=>array('var' => 'value')))));
		$this->assertEqual($this->TestObject->controller->viewVars,$expected);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
}
?>
