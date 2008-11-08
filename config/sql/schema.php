<?php 
/* SVN FILE: $Id$ */
/* Osmosis schema generated on: 2008-06-18 12:06:42 : 1213809342*/
class OsmosisSchema extends CakeSchema {
	var $name = 'Osmosis';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $acos = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'model' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'foreign_key' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'alias' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'lft' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'rght' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $aros = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'model' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'foreign_key' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'alias' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'lft' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'rght' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $aros_acos = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'aro_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'aco_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'_create' => array('type'=>'integer', 'null' => false, 'default' => '0'),
			'_read' => array('type'=>'integer', 'null' => false, 'default' => '0'),
			'_update' => array('type'=>'integer', 'null' => false, 'default' => '0'),
			'_delete' => array('type'=>'integer', 'null' => false, 'default' => '0'),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $course_tools = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false, 'key' => 'index'),
			'plugin_id' => array('type'=>'integer', 'null' => false, 'length' => 4),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'course_id' => array('column' => array('course_id', 'plugin_id'), 'unique' => 1))
		);
	var $courses = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'owner_id' => array('type'=>'integer', 'null' => false),
			'department_id' => array('type'=>'integer', 'null' => false, 'length' => 4),
			'code' => array('type'=>'string', 'null' => false, 'length' => 10),
			'name' => array('type'=>'string', 'null' => false, 'length' => 100),
			'description' => array('type'=>'text', 'null' => false),
			'created' => array('type'=>'date', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $courses_members = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false, 'key' => 'index'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'role_id' => array('type'=>'integer', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'member_id' => array('column' => array('member_id', 'course_id'), 'unique' => 1))
		);
	var $departments = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'length' => 150),
			'description' => array('type'=>'text', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $members = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'institution_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
			'full_name' => array('type'=>'string', 'null' => false, 'length' => 50),
			'email' => array('type'=>'string', 'null' => false, 'length' => 50),
			'phone' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
			'country' => array('type'=>'string', 'null' => false, 'length' => 20),
			'city' => array('type'=>'string', 'null' => false, 'length' => 50),
			'age' => array('type'=>'integer', 'null' => true, 'length' => 2),
			'sex' => array('type'=>'string', 'null' => false, 'default' => 'M', 'length' => 1),
			'username' => array('type'=>'string', 'null' => false, 'length' => 15),
			'password' => array('type'=>'string', 'null' => false, 'length' => 50),
			'last_seen' => array('type'=>'integer', 'null' => false),
			'admin' => array('type'=>'boolean', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $model_logs = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'member_id' => array('type'=>'integer', 'null' => false),
			'model' => array('type'=>'string', 'null' => false, 'length' => 50),
			'entity_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'created' => array('type'=>'boolean', 'null' => false),
			'time' => array('type'=>'integer', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $plugins = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 4, 'key' => 'primary'),
			'title' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
			'active' => array('type'=>'boolean', 'null' => false),
			'name' => array('type'=>'string', 'null' => false, 'length' => 100),
			'description' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'author' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
			'types' => array('type'=>'string', 'null' => false, 'default' => 'tool', 'length' => 30),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $roles = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'role' => array('type'=>'string', 'null' => false, 'length' => 10),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
		);
	var $tags = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'length' => 30, 'key' => 'unique'),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
		);
}
?>