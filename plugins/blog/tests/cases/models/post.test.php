<?php 

App::import('Model', 'Blog.Blog');
App::import('Model', 'Blog.Post');

class PostTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('blog','post');

	function setUp() {
		$this->TestObject = new Post();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->Blog->useDbConfig = 'test_suite';
		$this->TestObject->Blog->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}
	
	function testValidation1() {
		
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(	
			'title' => 'Error.empty',
			'body' => 'Error.empty',
			'created' => 'Error.empty',
			'modified' => 'Error.empty',
			'blog_id'=> 'Error.empty',		
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	/*function testValidation2() {
		
		$data = array();
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(	
			'title' => 'Error.minlength',
			'body' => 'Error.empty',
			'created' => 'Error.empty',
			'modified' => 'Error.empty',
			'blog_id'=> 'Error.empty',		
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
*/
	function testSave(){
		$data = array(
			'title' => 'post title',
			'body' => 'post body',
			'created' => 'created date',
			'modified' => 'modified date',
			'blog_id'=> 'blog id',
			'slug' => 'slug'
		);
		$this->TestObject->save($data);
		$id = $this->TestObject->getLastInsertId();
		$result = $this->TestObject->find(array('Post.id'=>$id));
		//$this->assertEqual(4,$this->TestObject->findCount());
		
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
