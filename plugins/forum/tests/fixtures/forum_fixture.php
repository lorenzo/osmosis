<?php 
/* SVN FILE: $Id$ */
/* Forum Fixure generated on: 2008-02-02 13:02:34 : 1201975054*/

class ForumFixture extends CakeTestFixture {
	var $name = 'Forum';
	var $table = 'forum_forums';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'course_id'  => 1
			));
}
?>
