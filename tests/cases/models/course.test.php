<?php 

App::import('Model', 'Course');

class CourseTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('course');
	function setUp() {
		$this->TestObject = new Course();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'department_id'		=> 'Error.empty',
			'owner_id'			=> 'Error.empty',
			'code' 				=> 'Error.empty',
			'name'				=> 'Error.empty',
			'description'		=> 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation2() {
		$this->TestObject->create();
		$this->TestObject->data = array(
			'Course' => array(
				'department_id' 	=> 'a',
				'owner_id' 			=> '1çb',
				'code' 				=> '1234567890a',
				'name' 				=> 'cosa ñángara',
				'description' 		=> 'xdf'
			)
		);
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'code'				=> 'Error.maxlength'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation3() {
		$this->TestObject->create();
		$this->TestObject->data = array(
			'Course' => array(
				'department_id' 	=> '1',
				'owner_id' 			=> '1413',
				'code' 				=> '1abc',
				'name' 				=> '<span>dasdas</span>',
				'description' 		=> 'xdf'
			)
		);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testValidation4() {
		$this->TestObject->id = 2;
		$this->TestObject->data = array(
			'Course' => array(
				'department_id'		=> 1,
				'owner_id'			=> 1,
				'code' 				=> '1abc',
				'name' 				=> '<span>dasdas</span>',
				'description' 		=> 'xdf'
			)
		);
		$valid = $this->TestObject->validates();
		$expectedErrors = array();
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
}
?>