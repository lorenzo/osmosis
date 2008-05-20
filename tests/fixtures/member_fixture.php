<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3

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
