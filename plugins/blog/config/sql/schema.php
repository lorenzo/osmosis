<?php
class BlogSchema extends CakeSchema {
	var $name = 'Blog';

	var $blog_blogs = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'title' => array('type'=>'string', 'null' => false, 'length' => 200),
			'description' => array('type'=>'text', 'null' => false),
			'member_id' => array('type'=>'string', 'null' => false, 'length' => 100),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $blog_posts = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'title' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 200),
			'body' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'blog_id' => array('type'=>'integer', 'null' => false),
			'slug' =>  array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 200),
			'member_id' => array('type'=>'integer', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $blog_comments = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'comment' => array('type'=>'text', 'null' => false),
			'post_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'created' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
}
?>
