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
class ControlModeFixture extends CakeTestFixture {
    var $name = 'ControlMode';
	var $table = 'scorm_control_modes';
  	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'choiceExit' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'choice' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'flow' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'forwardOnly' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'useCurrentAttemptObjectiveInfo' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'useCurrentAttemptProgressInfo' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
    var $records = array(
    	array(
    		'id'							=> 1,
    		'sco_id'                        => 1,
    		'choiceExit'					=> 'false',
			'choice'						=> 'true',
			'flow'							=> 'false',
			'forwardOnly'					=> 'false',
			'useCurrentAttemptObjectiveInfo'=> 'true',
			'useCurrentAttemptProgressInfo'	=> 'true'
		),
    );
} 
?>
