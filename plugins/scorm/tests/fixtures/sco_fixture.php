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
class ScoFixture extends CakeTestFixture {
    var $name = 'ScormSco';
  	var $table = 'scorm_scos';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'scorm_id' => array('type'=>'integer', 'null' => false),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'manifest' => array('type'=>'string', 'null' => false),
			'organization' => array('type'=>'string', 'null' => false),
			'identifier' => array('type'=>'string', 'null' => false),
			'href' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'title' => array('type'=>'string', 'null' => false),
			'completionThreshold' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 3),
			'parameters' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'isvisible' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'attemptAbsoluteDurationLimit' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 6),
			'dataFromLMS' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'attemptLimit' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 10),
			'scormType' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 6),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			); 
} 
?>
