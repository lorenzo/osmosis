<?php 
/* SVN FILE: $Id$ */
/* DocumentsController Test cases generated on: 2008-04-29 01:04:49 : 1209445369*/
App::import('Controller', 'Locker.Documents');

class TestDocuments extends DocumentsController {
	var $autoRender = false;
}

class DocumentsControllerTest extends CakeTestCase {
	var $Documents = null;

	function setUp() {
		$this->Documents = new TestDocuments();
	}

	function testDocumentsControllerInstance() {
		$this->assertTrue(is_a($this->Documents, 'DocumentsController'));
	}

	function tearDown() {
		unset($this->Documents);
	}
}
?>