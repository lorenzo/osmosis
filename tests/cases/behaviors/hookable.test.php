<?php

App::import('Behavior', 'Hookable');
App::import('Model', 'Member');
$configs =& Configure::getInstance();
$configs->pluginPaths[] = TESTS . 'fixtures' . DS .'plugins' . DS;

class HookableModel extends CakeTestModel {
	var $name = 'HookableModel';
	var $useTable = 'hookables';
	var $cacheQueries = false;
	var $actsAs = array('Hookable');
}
/**
 * Test case for Hookable Behavior
 *
 */
class HookableTestCase extends CakeTestCase {
	/**
	 * Fixtures associated with this test case
	 *
	 * @var array
	 * @access public
	 */
	var $fixtures = array('hookable_model');
	
	function setUp() {
		
	}
	
	function tearDown() {
		unset($this->Model);
		ClassRegistry::flush();
	}
	
	function testBeforeValidate() {
		$this->Model =& new HookableModel();
		$hookable =& new HookableBehavior();
		$data = array('HookableModel' => array(
			'locale' => 'eng',
			'model'	=> 'AModel',
			)
		);
		$this->Model->set($data);
		
		$hookable->beforeValidate($this->Model);
		$data = array('HookableModel' => array(
			'locale' => 'esp',
			'model'	=> 'AnotherModel',
			)
		);
		$this->assertEqual($this->Model->data,$data);
	}
	
	function testBeforeSave() {
		$this->Model =& new HookableModel();
		$data = array('HookableModel' => array(
			'locale' => 'eng',
			'model'	=> 'AModel',
			)
		);
		$data = array('HookableModel' => array(
			'locale' => 'esp',
			'model'	=> 'AnotherModel',
			'foreign_key' => '1',
			'field' => 'afield',
			'content' => 'Some content'
			)
		);
		$result = $this->Model->save($data);
		$data['Assoc']['title'] = 'a new assoc';
		$data['HookableModel']['newfield'] = 'a new field';
		$this->assertEqual($data,$result);
	}
	
	function testBeforeFind() {
		$this->Model =& new HookableModel();
		$this->Model->find('all');
	}
	
	function testBeforeDelete() {
		$this->Model =& new HookableModel();
		$this->Model->del(1);
	}
	
	function testAfterSave() {
		$this->Model =& new HookableModel();
		$this->Model->save(array());
	}
	function testAfterFind() {
		$this->Model =& new HookableModel();
		$this->Model->find('all');
	}
	
	function testAfterDelete() {
		$this->Model =& new HookableModel();
		$this->Model->del(1);
	}
	
}

?>
