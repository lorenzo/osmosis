<?php 
/* SVN FILE: $Id$ */
/* Topic Fixure generated on: 2008-02-02 14:02:10 : 1201975390*/

class TopicFixture extends CakeTestFixture {
	var $name = 'Topic';
	var $table = 'topics';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'title' => array('type'=>'string', 'null' => false),
			'forum_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => false),
			'locked' => array('type'=>'boolean', 'null' => false),
			'status' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'title'  => 'Lorem ipsum dolor sit amet',
			'forum_id'  => 1,
			'member_id'  => 1,
			'created'  => '2008-02-02 14:03:10',
			'locked'  => 1,
			'status'  => 'Lorem ipsum dolor '
			));
}
?>