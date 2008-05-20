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
