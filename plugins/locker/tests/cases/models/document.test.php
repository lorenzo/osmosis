<?php 
/* SVN FILE: $Id$ */
/* Document Test cases generated on: 2008-04-29 00:04:34 : 1209445054*/
App::import('Model', 'Locker.Document');

class TestDocument extends Document {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class DocumentTestCase extends CakeTestCase {
	var $Document = null;
	var $fixtures = array('plugin.locker.document', 'plugin.lockermember', 'plugin.lockerdirectory');

	function start() {
		parent::start();
		$this->Document = new TestDocument();
	}

	function testDocumentInstance() {
		$this->assertTrue(is_a($this->Document, 'Document'));
	}

	function testDocumentFind() {
		$results = $this->Document->recursive = -1;
		$results = $this->Document->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Document' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
									phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,
									vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,
									feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.
									Orci aliquet, in lorem et velit maecenas luctus, wisi nulla at, mauris nam ut a, lorem et et elit eu.
									Sed dui facilisi, adipiscing mollis lacus congue integer, faucibus consectetuer eros amet sit sit,
									magna dolor posuere. Placeat et, ac occaecat rutrum ante ut fusce. Sit velit sit porttitor non enim purus,
									id semper consectetuer justo enim, nulla etiam quis justo condimentum vel, malesuada ligula arcu. Nisl neque,
									ligula cras suscipit nunc eget, et tellus in varius urna odio est. Fuga urna dis metus euismod laoreet orci,
									litora luctus suspendisse sed id luctus ut. Pede volutpat quam vitae, ut ornare wisi. Velit dis tincidunt,
									pede vel eleifend nec curabitur dui pellentesque, volutpat taciti aliquet vivamus viverra, eget tellus ut
									feugiat lacinia mauris sed, lacinia et felis.',
			'member_id'  => 1,
			'directory_id'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>