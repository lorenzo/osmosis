<?php 
/* SVN FILE: $Id$ */
/* Response Test cases generated on: 2008-02-02 14:02:37 : 1201975837*/
App::import('Model', 'Response');

class TestResponse extends Response {
	var $cacheSources = false;
}

class ResponseTestCase extends CakeTestCase {
	var $Response = null;
	var $fixtures = array('app.response', 'app.discussion', 'app.member');

	function start() {
		parent::start();
		$this->Response = new TestResponse();
	}

	function testResponseInstance() {
		$this->assertTrue(is_a($this->Response, 'Response'));
	}

	function testResponseFind() {
		$results = $this->Response->recursive = -1;
		$results = $this->Response->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Response' => array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'discussion_id'  => 'Lorem ipsum dolor sit amet',
			'member_id'  => 1,
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
			'created'  => '2008-02-02 14:10:37'
			));
		$this->assertEqual($results, $expected);
	}
}
?>