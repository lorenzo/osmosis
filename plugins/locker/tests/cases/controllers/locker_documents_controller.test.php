<?php 
/* SVN FILE: $Id$ */
/* LockerDocumentsController Test cases generated on: 2008-04-29 15:04:48 : 1209497268*/
App::import('Controller', 'Locker.LockerDocuments');

class TestLockerDocuments extends LockerDocumentsController {
	var $autoRender = false;
}

class LockerDocumentsControllerTest extends CakeTestCase {
	var $LockerDocuments = null;

	function setUp() {
		$this->LockerDocuments = new TestLockerDocuments();
	}

	function testLockerDocumentsControllerInstance() {
		$this->assertTrue(is_a($this->LockerDocuments, 'LockerDocumentsController'));
	}

	function tearDown() {
		unset($this->LockerDocuments);
	}
}
?>