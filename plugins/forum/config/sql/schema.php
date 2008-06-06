<?php
class ForumSchema extends CakeSchema {
	var $name = 'Forum';

	var $forum_discussions =  array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'topic_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'title' => array('type'=>'string', 'null' => false),
			'content' => array('type'=>'text', 'null' => false),
			'sticky' => array('type'=>'boolean', 'null' => false),
			'status' => array('type'=>'string', 'null' => false, 'default' => 'unlocked', 'length' => 20),
			'response_count' => array('type'=>'integer', 'null' => false),
			'discussion_visit_count' => array('type'=>'integer', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => false),
			'modified' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $forum_topics =	array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false, 'length' => 120),
			'description' => array('type'=>'string', 'null' => false),
			'forum_id' => array('type'=>'integer', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => false),
			'status' => array('type'=>'string', 'null' => false, 'default' => 'unlocked', 'length' => 20),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $forum_responses =	array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'discussion_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'member_id' => array('type'=>'integer', 'null' => false),
			'content' => array('type'=>'text', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => false),
			'modified' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
}
?>
