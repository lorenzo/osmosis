<?php
/**
 * Test order is important.
 */

App::import('Component','Placeholder');
$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;

class ContactTestController extends Controller {
	var $name = 'ContactTest';
	var $uses = null;
}

class PlaceHolderComponentTestCase extends CakeTestCase {
	var $TestObject = null;
	
	function setUp() {
		$this->TestObject = new PlaceholderComponent();
		$this->TestObject->startup(new ContactTestController);
	}
	
	function testAttach() {
		$this->assertTrue(is_a($this->TestObject->controller,'ContactTestController'));
		$this->TestObject->attach(array('menu','other'));
		$this->assertEqual(array('FakeMenuHolder','Fake2OtherHolder'),$this->TestObject->controller->components);
		$this->assertTrue(is_a($this->TestObject->controller->FakeMenuHolder,'FakeMenuHolderComponent'));
		$this->assertTrue(is_a($this->TestObject->controller->Fake2OtherHolder,'Fake2OtherHolderComponent'));
		$expected = array(
			'placeholders' => array(
				'menu' => array(
					'FakeMenu' => array('cache'=>'+1 hour','data'=>array('var' => 'value'))),
				'other' => array(
					'Fake2Other' => array('cache'=>'+1 hour','data'=>array('var' => 'value')))
				)
			);
		$this->assertEqual($this->TestObject->controller->viewVars,$expected);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
}
?>
