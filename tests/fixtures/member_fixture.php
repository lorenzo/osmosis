<?php 
/* SVN FILE: $Id$ */
/* Member Fixure generated on: 2008-05-14 12:05:27 : 1210782627*/

class MemberFixture extends CakeTestFixture {
	var $name = 'Member';
	var $table = 'members';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'institution_id' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
			'full_name' => array('type'=>'string', 'null' => false, 'length' => 50),
			'email' => array('type'=>'string', 'null' => false, 'length' => 50),
			'phone' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 20),
			'country' => array('type'=>'string', 'null' => false, 'length' => 20),
			'city' => array('type'=>'string', 'null' => false, 'length' => 50),
			'age' => array('type'=>'integer', 'null' => false, 'length' => 2),
			'sex' => array('type'=>'string', 'null' => false, 'default' => 'M', 'length' => 1),
			'role_id' => array('type'=>'integer', 'null' => false),
			'username' => array('type'=>'string', 'null' => false, 'length' => 15),
			'password' => array('type'=>'string', 'null' => false, 'length' => 50),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'institution_id'  => 'Lorem ipsum dolor ',
			'full_name'  => 'Lorem ipsum dolor sit amet',
			'email'  => 'Lorem ipsum dolor sit amet',
			'phone'  => 'Lorem ipsum dolor ',
			'country'  => 'Lorem ipsum dolor ',
			'city'  => 'Lorem ipsum dolor sit amet',
			'age'  => 1,
			'sex'  => 'Lorem ipsum dolor sit ame',
			'role_id'  => 1,
			'username'  => 'Lorem ipsum d',
			'password'  => 'Lorem ipsum dolor sit amet'
			));
}
?>