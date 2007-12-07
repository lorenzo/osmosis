<?php 

App::import('Model', 'Blog.Blog');

class BlogTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('blog');

	function setUp() {
		$this->TestObject = new Blog();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->Revision->useDbConfig = 'test_suite';
		$this->TestObject->Revision->tablePrefix = 'test_suite_';
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
			'description' => 'Error.empty',
			'owner' => 'Error.empty'
		);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}

	function testSave(){
		$data = array(
			'title'		=> 'blog title',
			'description'	=> 'A blog test_suite',
			'owner'		=> 'Owner',
		);
		$this->TestObject->save($data);
		$id = $this->TestObject->getLastInsertId();
		$result = $this->TestObject->find(array('id'=>$id));
		$this->assertEqual(4,$this->TestObject->findCount());
		
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
