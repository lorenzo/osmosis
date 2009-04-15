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
class Objective extends ScormAppModel {

	var $name = 'Objective';
	var $useTable = 'scorm_objectives';
	var $hasOne = array(
			'MapInfo' => array('className' => 'Scorm.MapInfo',
								'foreignKey' => 'objective_id',
								'dependent' => true)
	);
	var $actsAs = array('transaction');
	var $validate = array(
			// 'objectiveID' => array(
			// 				'required' =>  array(
			// 					'rule' => VALID_NOT_EMPTY,
			// 					'message' => 'scormplugin.objective.objectiveid.empty',
			// 					'required' => true,
			// 					'allowEmpty'
			// 				)
			// 			),
			'satisfiedByMeasure' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.objective.satisfiedbymeasure.boolean',
					'required' => false
				)
			),
			'minNormalizedMeasure' => array(
				'required' =>  array(
					'rule' => 'decimal',
					'message' => 'scormplugin.objective.minnormalizedmeasure.decimal',
					'required' => false),
				'greater' =>  array(
					'rule' => array('comparison','>=',-1),
					'message' => 'scormplugin.objective.minnormalizedmeasure.between',
					'required' => false),
				'less' =>  array(
					'rule' => array('comparison','<=',1),
					'message' => 'scormplugin.objective.minnormalizedmeasure.between',
					'required' => false)
			)	
		);
	
	function save($data=null,$validate=true,$fields=array()) {
		$this->begin();
		$saved = parent::save($data,$validate,$fields);
		if($saved && isset($data['MapInfo'])) {
				$data['MapInfo']['objective_id'] = $this->getLastInsertId();
				$saved = $this->MapInfo->save($data);
		}
		if($saved) {
			$this->commit();
		} else {
			$this->rollback();
		}
		return $saved;
	}
}
?>
