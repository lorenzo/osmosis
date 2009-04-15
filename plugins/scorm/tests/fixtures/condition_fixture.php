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
class ConditionFixture extends CakeTestFixture {
	var $name = 'Condition';
	var $table = 'scorm_conditions';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'referencedObjective' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'measureThreshold' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 7),
			'operator' => array('type'=>'string', 'null' => true, 'default' => 'noOp', 'length' => 4),
			'ruleCondition' => array('type'=>'string', 'null' => false, 'length' => 27),
			'rule_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(
		array(
			'id'					=> 1,
			'referencedObjective'	=> 'HOLA',
			'measureThreshold'		=> '0.05832',
			'operator'			=> 'noOp',
			'ruleCondition'			=> 'always'
		)
	);
}
?>
