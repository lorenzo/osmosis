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
 */
class ScormFixture extends CakeTestFixture {
    var $name = 'Scorm';
  	var $table = 'scorm_scorms'; 
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false),
			'file_name' => array('type'=>'string', 'null' => false),
			'description' => array('type'=>'text', 'null' => false),
			'version' => array('type'=>'string', 'null' => false, 'length' => 9),
			'created' => array('type'=>'datetime', 'null' => false),
			'modified' => array('type'=>'datetime', 'null' => false),
			'hash' => array('type'=>'string', 'null' => false, 'length' => 35),
			'path' => array('type'=>'text', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'		=> 	1,
    		'course_id'	=>	1,
    		'name'	=> 'testScorm',
    		'file_name' => 'ScromTest.zip',
    		'description' => 'A scorm test',
    		'version'	=> '1.3',
    		'created' => '2007-1-1',
    		'modified'	=> '2007-1-1',
    		'hash'		=> 'slsdaslkfwerew498fwlw'
		)
    );
} 
?>
