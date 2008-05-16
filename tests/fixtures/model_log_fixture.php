<?php 
/* SVN FILE: $Id$ */
/* ModelLog Fixure generated on: 2008-05-13 19:05:50 : 1210721510*/

class ModelLogFixture extends CakeTestFixture {
	var $name = 'ModelLog';
	var $table = 'model_logs';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false),
			'model' => array('type'=>'string', 'null' => false, 'length' => 50),
			'entity_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'type' => array('type'=>'string', 'null' => false, 'length' => 8),
			'created' => array('type'=>'datetime', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'member_id'  => 1,
			'model'  => 'Lorem ipsum dolor sit amet',
			'entity_id'  => 'Lorem ipsum dolor sit amet',
			'type'  => 'Lorem ',
			'created'  => '2008-05-13 19:01:50'
			));
}
?>