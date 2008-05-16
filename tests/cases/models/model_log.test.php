<?php 
/* SVN FILE: $Id$ */
/* ModelLog Test cases generated on: 2008-05-13 19:05:50 : 1210721510*/
App::import('Model', 'ModelLog');

class TestModelLog extends ModelLog {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class ModelLogTestCase extends CakeTestCase {
	var $ModelLog = null;
	var $fixtures = array('app.model_log', 'app.member');

	function start() {
		parent::start();
		$this->ModelLog = new TestModelLog();
	}

	function testModelLogInstance() {
		$this->assertTrue(is_a($this->ModelLog, 'ModelLog'));
	}

	function testModelLogFind() {
		$results = $this->ModelLog->recursive = -1;
		$results = $this->ModelLog->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('ModelLog' => array(
			'id'  => 1,
			'member_id'  => 1,
			'model'  => 'Lorem ipsum dolor sit amet',
			'entity_id'  => 'Lorem ipsum dolor sit amet',
			'type'  => 'Lorem ',
			'created'  => '2008-05-13 19:01:50'
			));
		$this->assertEqual($results, $expected);
	}
}
?>