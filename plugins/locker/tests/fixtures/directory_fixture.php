<?php 
/* SVN FILE: $Id$ */
/* Directory Fixure generated on: 2008-04-29 00:04:07 : 1209445027*/

class DirectoryFixture extends CakeTestFixture {
	var $name = 'Directory';
	var $table = 'directories';
	var $fields = array(
			'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'length' => 100),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet'
			));
}
?>