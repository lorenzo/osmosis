<?php 
/* SVN FILE: $Id$ */
/* Directory Test cases generated on: 2008-04-29 00:04:07 : 1209445027*/
App::import('Model', 'Locker.Directory');

class TestDirectory extends Directory {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class DirectoryTestCase extends CakeTestCase {
	var $Directory = null;
	var $fixtures = array('plugin.locker.directory', 'plugin.lockerdocument');

	function start() {
		parent::start();
		$this->Directory = new TestDirectory();
	}

	function testDirectoryInstance() {
		$this->assertTrue(is_a($this->Directory, 'Directory'));
	}

	function testDirectoryFind() {
		$results = $this->Directory->recursive = -1;
		$results = $this->Directory->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Directory' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>