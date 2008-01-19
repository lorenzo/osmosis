<?php

App::import('Behavior', 'Hookable');
App::import('Model', 'Course');


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
	var $fixtures = array('course');
	
	function setUp() {
		$this->Model = new Course();
		$this->Model->useDbConfig = 'test';
	}
	
	function tearDown() {
		unset($this->Model);
		ClassRegistry::flush();
	}
	
	function testBeforeValidate() {
		$hookable =& new HookableBehavior();
		$hookable->beforeValidate($this->Model);
	}
	
	function testBeforeSave() {
		$this->Model->save(array());
	}
	
	function testBeforeFind() {
		$this->Model->find('all');
	}
	
	function testBeforeDelete() {
		$this->Model->del(1);
	}
	
	function testAfterSave() {
		$this->Model->save(array());
	}
	function testAfterFind() {
		$this->Model->find('all');
	}
	
	function testAfterDelete() {
		$this->Model->del(1);
	}
	
}

?>
