<?php 
/* SVN FILE: $Id$ */
/* Discussion Test cases generated on: 2008-02-02 14:02:13 : 1201975693*/
App::import('Model', 'Discussion');

class TestDiscussion extends Discussion {
	var $cacheSources = false;
}

class DiscussionTestCase extends CakeTestCase {
	var $Discussion = null;
	var $fixtures = array('app.discussion', 'app.subject', 'app.member', 'app.response');

	function start() {
		parent::start();
		$this->Discussion = new TestDiscussion();
	}

	function testDiscussionInstance() {
		$this->assertTrue(is_a($this->Discussion, 'Discussion'));
	}

	function testDiscussionFind() {
		$results = $this->Discussion->recursive = -1;
		$results = $this->Discussion->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Discussion' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'subject_id'  => 1,
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
			'locked'  => 1,
			'status'  => 'Lorem ipsum dolor '
			));
		$this->assertEqual($results, $expected);
	}
}
?>