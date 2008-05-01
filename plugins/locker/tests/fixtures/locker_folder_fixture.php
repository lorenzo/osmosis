<?php 
/* SVN FILE: $Id$ */
/* LockerFolder Fixure generated on: 2008-04-29 15:04:25 : 1209497005*/

class LockerFolderFixture extends CakeTestFixture {
	var $name = 'LockerFolder';
	var $table = 'locker_folders';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'length' => 100),
			'parent_id' => array('type'=>'string', 'null' => false, 'length' => 36),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'parent_id'  => 'Lorem ipsum dolor sit amet'
			));
}
?>