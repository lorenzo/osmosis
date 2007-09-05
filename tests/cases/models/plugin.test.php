<?php 

loadModel('Plugin');

class PluginTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('plugin');
	function setUp() {
		$this->TestObject = new Plugin();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->loadInfo(true);
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testActives() {
		$result = $this->TestObject->actives();
		$expect = array(
			array('Plugin'=>array('id'=>1,'name'=>'plugin1','active'=>1)),
			array('Plugin'=>array('id'=>3,'name'=>'plugin3','active'=>1)),
		);
		$this->assertEqual($result,$expect);
	}

}
?>