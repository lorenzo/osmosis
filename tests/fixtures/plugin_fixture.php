<?php 
/* SVN FILE: $Id$ */
/* Plugin Fixure generated on: 2008-04-23 13:04:14 : 1208972774*/

class PluginFixture extends CakeTestFixture {
	var $name = 'Plugin';
	var $table = 'plugins';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary'),
			'title' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
			'active' => array('type'=>'boolean', 'null' => false),
			'name' => array('type'=>'string', 'null' => false, 'length' => 100),
			'description' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'author' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
			'types' => array('type'=>'string', 'null' => false, 'default' => 'tool', 'length' => 30),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'  => 1,
			'title'  => 'The Fake Plugin',
			'active'  => 1,
			'name'  => 'Fake',
			'description'  => 'Lorem ipsum dolor sit amet',
			'author'  => 'Lorem ipsum dolor sit amet',
			'types'  => 'hook'
			),
		array(
			'id'  => 2,
			'title'  => 'The Fake Plugin 2 (improved)',
			'active'  => 1,
			'name'  => 'Fake2',
			'description'  => 'Lorem ipsum dolor sit amet',
			'author'  => 'Lorem ipsum dolor sit amet',
			'types'  => 'tool,hook'
			),
		array(
			'id'  => 3,
			'title'  => 'The Fakest of all',
			'active'  => 0,
			'name'  => 'Plug',
			'description'  => 'Lorem ipsum dolor sit amet',
			'author'  => 'Lorem ipsum dolor sit amet',
			'types'  => 'other'
			)
		);
}
?>