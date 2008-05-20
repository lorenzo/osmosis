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
class RollupConsideration extends ScormAppModel {

	var $name = 'RollupConsideration';
	var $useTable = 'scorm_rollup_considerations';
	var $validate = array(
			'requiredForSatisfied' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredforsatisfied.token',
					'required' => false
				)
			),
			'requiredForNotSatisfied' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredfornotsatisfied.token',
					'required' => false
				)
			),
			'requiredForComplete' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredforcomplete.token',
					'required' => false
				)
			),
			'requiredForIncomplete' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredforincomplete.token',
					'required' => false
				)
			),
			'measureSatisfactionIfActive' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.rollupconsideration.measuresatisfactionifactive.boolean',
					'required' => false
				)
			)
		);
	
function ValidateToken($field){
	$regex = ('/(always|ifAttempted|ifNotSkipped|ifNotSuspended)/');
	return preg_match($regex,array_shift($field));
	}
}
?>
