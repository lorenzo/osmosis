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
}
?>