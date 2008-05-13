<?php 
/* SVN FILE: $Id$ */
/* OnlineUser Fixure generated on: 2008-05-05 13:05:52 : 1210009732*/

class OnlineUserFixture extends CakeTestFixture {
	var $name = 'OnlineUser';
	var $table = 'online_users';
	var $fields = array(
			'member_id' => array('type'=>'integer', 'null' => false, 'length' => 10, 'key' => 'primary'),
			'modified' => array('type'=>'datetime', 'null' => false),
			'viewing' => array('type'=>'string', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'member_id', 'unique' => 1))
			);
	var $records = array(array(
			'member_id'  => 1,
			'modified'  => '2008-05-05 13:48:52',
			'viewing'  => 'Lorem ipsum dolor sit amet'
			));
}
?>