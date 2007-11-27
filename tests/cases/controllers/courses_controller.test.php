<?php 

loadController('Courses');

class CoursesControllerTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new CoursesController();
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testAdd() {
		
	}
}
?>