<?php 
/* SVN FILE: $Id$ */
/* Plugin Test cases generated on: 2008-04-23 13:04:15 : 1208972775*/
App::import('Model', 'Plugin');

class TestPlugin extends Plugin {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class PluginTestCase extends CakeTestCase {
	var $Plugin = null;
	var $fixtures = array('app.plugin');

	function start() {
		parent::start();
		$this->Plugin = new TestPlugin();
	}

	function testPluginInstance() {
		$this->assertTrue(is_a($this->Plugin, 'Plugin'));
	}

	function testPluginFind() {
		$results = $this->Plugin->recursive = -1;
		$results = $this->Plugin->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Plugin' => array(
			'id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'active'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'description'  => 'Lorem ipsum dolor sit amet',
			'author'  => 'Lorem ipsum dolor sit amet',
			'types'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>