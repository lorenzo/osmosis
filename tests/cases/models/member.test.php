<?php 

App::import('Model', 'Member');

class MemberTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('member');

	function setUp() {
		$this->TestObject = new Member();
		$this->TestObject->useDbConfig = 'test';
		//$this->TestObject->Role->useDbConfig = 'test';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	
	function testParentNode() {
		$this->TestObject->id = 1;
		$result = $this->TestObject->parentNode();
		$expected = array('model'=>'Role','foreign_key'=>1);
		$this->assertEqual($result, $expected);
	}
	
	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		debug($this->TestObject->validate);
		$valid = $this->TestObject->validates();
		$this->assertFalse($valid);
		$expectedErrors = array(
			'department_id'		=> 'Error.empty',
			'owner_id'			=> 'Error.empty',
			'code' 				=> 'Error.empty',
			'name'				=> 'Error.empty',
			'description'		=> 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

}
?>