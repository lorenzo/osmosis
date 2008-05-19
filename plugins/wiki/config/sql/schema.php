<?php 

class WikiSchema extends CakeSchema {
	var $name = 'Wiki';

	var $wiki_wikis = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false),
			'description' => array('type'=>'text', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $wiki_entries = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'wiki_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'title' => array('type'=>'string', 'null' => false,'length' => 100),
			'content' => array('type'=>'text', 'null' => false),
			'revision' => array('type'=>'integer', 'null' => false, 'default' => '1', 'length' => 6),
			'created' => array('type'=>'datetime', 'null' => false),
			'updated' => array('type'=>'datetime', 'null' => false),
			'slug' => array('type'=>'string', 'null' => false,'length' => 110),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $wiki_revisions = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'entry_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'title' => array('type'=>'string', 'null' => false),
			'content' => array('type'=>'text', 'null' => false),
			'revision' => array('type'=>'integer', 'null' => false, 'length' => 6),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
}
?>