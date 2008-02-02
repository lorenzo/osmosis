<?php 
/* SVN FILE: $Id$ */
/* Locker Fixure generated on: 2008-02-02 17:02:54 : 1201989054*/

class LockerFixture extends CakeTestFixture {
	var $name = 'Locker';
	var $table = 'lockers';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'member_id' => array('type'=>'integer', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'member_id'  => 1
			));
}
?>