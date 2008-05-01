<?php 
/* SVN FILE: $Id$ */
/* DirectoriesController Test cases generated on: 2008-04-29 00:04:30 : 1209445110*/
App::import('Controller', 'Locker.Directories');

class TestDirectories extends DirectoriesController {
	var $autoRender = false;
}

class DirectoriesControllerTest extends CakeTestCase {
	var $Directories = null;

	function setUp() {
		$this->Directories = new TestDirectories();
	}

	function testDirectoriesControllerInstance() {
		$this->assertTrue(is_a($this->Directories, 'DirectoriesController'));
	}

	function tearDown() {
		unset($this->Directories);
	}
}
?>