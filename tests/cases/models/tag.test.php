<?php 
/* SVN FILE: $Id$ */
/* Tag Test cases generated on: 2008-05-12 18:05:35 : 1210631555*/
App::import('Model', 'Tag');

class TestTag extends Tag {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class TagTestCase extends CakeTestCase {
	var $Tag = null;
	var $fixtures = array('app.tag');

	function start() {
		parent::start();
		$this->Tag = new TestTag();
	}

	function testTagInstance() {
		$this->assertTrue(is_a($this->Tag, 'Tag'));
	}

	function testTagFind() {
		$results = $this->Tag->recursive = -1;
		$results = $this->Tag->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Tag' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'created'  => '2008-05-12 18:32:35'
			));
		$this->assertEqual($results, $expected);
	}
}
?>