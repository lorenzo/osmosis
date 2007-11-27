<?php 

loadModel('Department');

class DepartmentTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Department();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
	/*
	 * Test field validation
	 */
	function testValidation() {
		$data = array('Department'=>array('name'=>'','description'=>'Esta es una descripcion'));
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$this->assertFalse($valid);
		$this->assertEqual($this->TestObject->validationErrors,array('name'=>'Error.empty'));
		
		$this->TestObject->create();
		$data = array('Department'=>array('name'=>'esto es un nombre','description'=>''));
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$this->assertFalse($valid);
		
		$this->assertEqual($this->TestObject->validationErrors,array('description'=>'Error.empty'));
	}
}
?>