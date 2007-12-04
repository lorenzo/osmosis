<?php 

App::import('Model', 'Blog.Blog');

class BlogTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Blog();
	}

	function tearDown() {
		unset($this->TestObject);
	}

	/*
	function testMe() {
		$result = $this->TestObject->findAll();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>
