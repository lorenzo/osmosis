<?php 

loadModel('Member');
loadModel('Role');

class RoleTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('member','role');

	function setUp() {
		$this->TestObject = new Role();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->Member->useDbConfig = 'test_suite';
		$this->TestObject->Member->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	
	function testParentNode() {
		$this->TestObject->id = 1;
		$result = $this->TestObject->parentNode();
		$expected = null;
		$this->assertEqual($result, $expected);
		$this->TestObject->id = 3;
		$result = $this->TestObject->parentNode();
		$expected = 2;
		$this->assertEqual($result, $expected);
	}
	
}
?>