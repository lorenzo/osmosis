<?php 

App::import('Model', 'Blog.Comment');

class CommentTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Comment();
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
