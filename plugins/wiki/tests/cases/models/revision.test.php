<?php 
/* SVN FILE: $Id$ */
/* WikiRevision Test cases generated on: 2008-05-14 12:05:15 : 1210782075*/
App::import('Model', 'Wiki.Revision');

class TestWikiRevision extends Revision {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class WikiRevisionTestCase extends CakeTestCase {
	var $WikiRevision = null;
	var $fixtures = array('plugin.wiki.revision', 'plugin.wiki.entry', 'member');

	function start() {
		parent::start();
		$this->WikiRevision = new TestWikiRevision();
	}

	function testWikiRevisionInstance() {
		$this->assertTrue(is_a($this->WikiRevision, 'Revision'));
	}

	function testWikiRevisionFind() {
		$results = $this->WikiRevision->recursive = -1;
		$results = $this->WikiRevision->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Revision' => array(
			'id'  => 1,
			'entry_id'  => 1,
			'member_id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'content'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
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
			'revision'  => 1,
			'created'  => '2008-05-14 12:21:15'
			));
		$this->assertEqual($results, $expected);
	}
}
?>