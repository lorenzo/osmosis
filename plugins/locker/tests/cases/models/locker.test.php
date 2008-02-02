<?php 
/* SVN FILE: $Id$ */
/* Locker Test cases generated on: 2008-02-02 17:02:54 : 1201989054*/
App::import('Model', 'Locker');

class TestLocker extends Locker {
	var $cacheSources = false;
}

class LockerTestCase extends CakeTestCase {
	var $Locker = null;
	var $fixtures = array('app.locker', 'app.member', 'app.document');

	function start() {
		parent::start();
		$this->Locker = new TestLocker();
	}

	function testLockerInstance() {
		$this->assertTrue(is_a($this->Locker, 'Locker'));
	}

	function testLockerFind() {
		$results = $this->Locker->recursive = -1;
		$results = $this->Locker->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Locker' => array(
			'id'  => 1,
			'member_id'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>