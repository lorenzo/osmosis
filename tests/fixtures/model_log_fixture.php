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
