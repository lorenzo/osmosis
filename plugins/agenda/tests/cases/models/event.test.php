<?php 
/* SVN FILE: $Id$ */
/* Event Test cases generated on: 2008-05-20 14:05:21 : 1211306721*/
App::import('Model', 'Agenda.Event');

class TestEvent extends Event {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class EventTestCase extends CakeTestCase {
	var $Event = null;
	var $fixtures = array('plugin.agenda.event');

	function start() {
		parent::start();
		$this->Event = new TestEvent();
	}

	function testEventInstance() {
		$this->assertTrue(is_a($this->Event, 'Event'));
	}

	function testEventFind() {
		$results = $this->Event->recursive = -1;
		$results = $this->Event->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Event' => array(
			'id'  => 1,
			'course_id'  => 1,
			'member_id'  => 1,
			'date'  => '2008-05-23 16:22:50',
			'location'  => 'Lorem ipsum dolor sit amet',
			'all_day'  => 1,
			'headline'  => 'Lorem ipsum dolor sit amet',
			'detail'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
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
									feugiat lacinia mauris sed, lacinia et felis.'
			));
		$this->assertEqual($results, $expected);
	}
}
?>