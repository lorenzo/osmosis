<?php 

loadModel('scorm.Scorm');

class CourseTestCase extends CakeTestCase {
	var $TestObject = null;
	function setUp() {
		$this->TestObject = new Scorm();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		//$this->TestObject->loadInfo(true);
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
	function testValidation1() {
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'name'				=> 'Error.empty',
			'description'		=> 'Error.empty',
			'course_id' 		=> 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testManifestExists() {
		$this->assertTrue($this->TestObject->manifestExists(TMP.'tests'));
		$this->assertFalse($this->TestObject->manifestExists(TMP.'fake'));
	}
	
	function testParseManifest() {
		$this->TestObject->parseManifest(TMP.'tests');
	}
	
}
?>