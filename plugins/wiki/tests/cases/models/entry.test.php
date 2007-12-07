<?php 

App::import('Model', 'wiki.Entry');

class EntryTestCase extends CakeTestCase {
	var $TestObject = null;
	var $fixtures = array('entry','revision');
	function setUp() {
		$this->TestObject = new Entry();
		$this->TestObject->useDbConfig = 'test_suite';
		$this->TestObject->tablePrefix = 'test_suite_';
		$this->TestObject->Revision->useDbConfig = 'test_suite';
		$this->TestObject->Revision->tablePrefix = 'test_suite_';
	}

	function tearDown() {
		unset($this->TestObject);
	}

	function testValidation1() {
		$data['Entry'] = array(
			'wiki_id' => '',
			'member_id' => '',
			'title' => '',
			'content' => ''
		);
		$this->TestObject->data = $data;
		$valid = $this->TestObject->validates();
		$expectedErrors = array(
			'wiki_id' => 'Error.empty',
			'member_id' => 'Error.empty',
			'title' => 'Error.empty',
			'content' => 'Error.empty'
			);
		$this->assertEqual($this->TestObject->validationErrors, $expectedErrors);
	}
	
	function testSave() {
		$data['Entry'] = array(
			'wiki_id' => 1,
			'member_id' => 1,
			'title' => 'An entry',
			'content' => 'Some content'
		);
		$this->TestObject->save($data);
		$id = $this->TestObject->getLastInsertId();
		$result = $this->TestObject->find(array('id'=>$id));
		$this->assertTrue(empty($result['Revision']));
		$entry = $result['Entry'];
		unset($entry['id']);
		unset($entry['created']);
		unset($entry['updated']);
		$this->assertEqual($entry['revision'],1);
		unset($entry['revision']);
		$this->assertEqual($entry,$data['Entry']);
		
		$new_data['Entry'] = array(
			'id' => $this->TestObject->getLastInsertId(),
			'wiki_id' => 2,
			'member_id' => 2,
			'title' => 'Trying to change the title, hihihi, I am bad',
			'content' => 'Some content with new words'
		);
		$this->TestObject->save($new_data);
		$this->TestObject->recursive = 1;
		$new_result = $this->TestObject->find(array('id'=>$id));
		$edit = $new_result['Entry'];
		unset($edit['created']);
		$updated = $edit['updated'];
		unset($edit['updated']);
		$new_data['Entry']['revision'] = 2;
		// Unchanged wiki id
		$new_data['Entry']['wiki_id'] = 1;
		// Unchanged title
		$new_data['Entry']['title'] = 'An entry';
		unset($edit['modified']);
		$this->assertEqual($edit,$new_data['Entry']);
		
		//Test there is a revision corresponding to the first insert
		$revision = $new_result['Revision'][0];
		unset($revision['id']);
		$expected = $data['Entry'];
		unset($expected['wiki_id']);
		$expected['entry_id'] = $id;
		$expected['revision'] = 1; 
		$expected['created'] = $updated; 
		$this->assertEqual($revision,$expected);
		
		//Finally check that another edit means a new revision
		$data['Entry'] = array(
			'id' => $id,
			'member_id' => 2,
			'content' => 'Some content with new words added'
		);
		$this->TestObject->save($data);
		$this->TestObject->recursive = 1;
		$result = $this->TestObject->find(array('id'=>$id));
		$this->assertEqual(2,count($result['Revision']));
	}
	
	/**
	 * Proves that an entry edit with no changes added means no new revisions
	 */
	
	function testSave2() {
		$data = $this->TestObject->find(array('id'=>1));
		$this->TestObject->save($data);
		$this->TestObject->recursive = 1;
		$result = $this->TestObject->find(array('id'=>1));
		$this->assertEqual(0,count($result['Revision']));
	}
	
	/**
	 * Tests restore function
	 */
	function testRestore() {
		$data = $this->TestObject->find(array('id'=>1));
		$content = $data['Entry']['content'];
		$data['Entry']['content'] = 'A very different content';
		$this->TestObject->save($data);
		$this->TestObject->restore(1);
		$result = $this->TestObject->find(array('id'=>1));
		$expected = $data['Entry'];
		$expected['content'] = $content;
		$expected['revision'] = 3;
		unset($expected['updated']);
		unset($result['Entry']['updated']);
		$this->assertEqual($expected,$result['Entry']);
	}
}
?>
