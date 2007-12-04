<?php 

App::import('Model', 'Blog.Post');

class PostTestCase extends CakeTestCase {
	var $TestObject = null;

	function setUp() {
		$this->TestObject = new Post();
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
