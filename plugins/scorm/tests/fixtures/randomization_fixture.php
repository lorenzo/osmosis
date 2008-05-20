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
class RandomizationFixture extends CakeTestFixture {
    var $name = 'ScormRandomization';
  	var $table = 'scorm_randomizations';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'randomizationTiming' => array('type'=>'string', 'null' => true, 'default' => 'never', 'length' => 16),
			'selectCount' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'reorderChildren' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'selectionTiming' => array('type'=>'string', 'null' => true, 'default' => 'never', 'length' => 16),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'					=> 1,
    		'randomizationTiming'	=> 'once',
    		'selectCount'			=> '12',
    		'reorderChildren'		=> 'true',
    		'selectionTiming'		=> 'onEachNewAttempt'
		),
    );
} 
?>
