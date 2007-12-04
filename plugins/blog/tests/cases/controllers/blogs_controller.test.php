<?php 

App::import('Controller', 'Blog.Blogs');

class BlogsControllerTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new BlogsController();
	}

	function tearDown() {
		unset($this->TestObject);
	}

	/*
	function testMe() {
		$result = $this->TestObject->index();
		$expected = 1;
		$this->assertEqual($result, $expected);
	}
	*/
}
?>
