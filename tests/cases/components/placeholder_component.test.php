<?php
/**
 * Test order is important.
 */

App::import('Component','Placeholder');
$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;


class PlaceHolderComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('app.plugin');
	
	function setUp() {
		$this->TestObject = new PlaceholderComponent();
		$this->TestObject->startup(new Controller);
		$this->TestObject->Plugin->useDbConfig = 'test';
	}
	
	function testAttach() {
		$this->assertTrue(is_a($this->TestObject->controller,'Controller'));
		$this->TestObject->attach(array('menu','other'));
		$this->assertEqual(array('FakeHolder','Fake2Holder'),$this->TestObject->controller->components);
		$this->assertTrue(is_a($this->TestObject->controller->FakeHolder,'FakeHolderComponent'));
		$this->assertTrue(is_a($this->TestObject->controller->Fake2Holder,'Fake2HolderComponent'));
		$expected = array(
			'placeholders' => array(
				'menu' => array(
					'FakeHolder' => array('cache'=>'+1 hour','data'=>array('var' => 'value'))),
				'other' => array(
					'Fake2Holder' => array('cache'=>'+1 hour','data'=>array('var' => 'value')))
				)
			);
		$this->assertEqual($this->TestObject->controller->viewVars,$expected);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
}
?>
