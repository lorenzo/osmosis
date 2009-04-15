<?php 
/* SVN FILE: $Id$ */
/* Event Fixure generated on: 2008-05-20 14:05:21 : 1211306721*/

class EventFixture extends CakeTestFixture {
	var $name = 'Event';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'member_id' => array('type'=>'integer', 'null' => false),
			'date' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'location' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
			'all_day' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
			'headline' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'detail' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'date'  => '2008-05-20 14:05:21',
			'course_id' => 1,
			'member_id' => 1,
			'location'  => 'Lorem ipsum dolor sit amet',
			'allday'  => 1,
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
}
?>