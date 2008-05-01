<?php 
/* SVN FILE: $Id$ */
/* LockerFoldersController Test cases generated on: 2008-04-29 15:04:02 : 1209497282*/
App::import('Controller', 'Locker.LockerFolders');

class TestLockerFolders extends LockerFoldersController {
	var $autoRender = false;
}

class LockerFoldersControllerTest extends CakeTestCase {
	var $LockerFolders = null;

	function setUp() {
		$this->LockerFolders = new TestLockerFolders();
	}

	function testLockerFoldersControllerInstance() {
		$this->assertTrue(is_a($this->LockerFolders, 'LockerFoldersController'));
	}

	function tearDown() {
		unset($this->LockerFolders);
	}
}
?>