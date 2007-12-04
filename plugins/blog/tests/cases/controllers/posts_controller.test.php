<?php 

App::import('Controller', 'Blog.Posts');

class PostsControllerTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new PostsController();
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
