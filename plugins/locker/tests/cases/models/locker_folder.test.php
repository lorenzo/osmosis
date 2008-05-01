<?php 
/* SVN FILE: $Id$ */
/* LockerFolder Test cases generated on: 2008-04-29 15:04:25 : 1209497005*/
App::import('Model', 'Locker.LockerFolder');

class TestLockerFolder extends LockerFolder {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class LockerFolderTestCase extends CakeTestCase {
	var $LockerFolder = null;
	var $fixtures = array('plugin.locker.locker_folder', 'plugin.lockerlocker_folder', 'plugin.lockerlocker_document');

	function start() {
		parent::start();
		$this->LockerFolder = new TestLockerFolder();
	}

	function testLockerFolderInstance() {
		$this->assertTrue(is_a($this->LockerFolder, 'LockerFolder'));
	}

	function testLockerFolderFind() {
		$results = $this->LockerFolder->recursive = -1;
		$results = $this->LockerFolder->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('LockerFolder' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'parent_id'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>