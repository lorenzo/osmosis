<?php 

App::import('Model', 'wiki.Wiki');

class WikiTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Wiki();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data['Wiki'] = array(
			'name' => '',
			'description' => '',
			'course_id' => '',
			);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'name' => 'Error.empty',
			'description' => 'Error.empty',
			'course_id' => 'Error.empty',
			);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
}
?>