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
class Rollup extends ScormAppModel {
	var $name = 'Rollup';
	var $useTable = 'scorm_rollups';
  var $actsAs = array('transaction');
	var $hasMany = array(
		'Rule' => array(
			'className' => 'Scorm.Rule',
			'foreignKey' => 'rollup_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'dependent' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	var $validate = array(
			'rollupObjectiveSatisfied' => array (
				'rule' => IS_BOOLEAN,
				'message' => 'scorm.rollup.rollupobjectivesatisfied.boolean',
				'allowEmpty' => false
			),
			'rollupProgressCompletion' => array (
				'rule' => IS_BOOLEAN,
				'message' => 'scorm.rollup.rollupprogresscompletion.boolean',
				'allowEmpty' => false
			),
			'objectiveMeasureWeight' => array (
				'Decimal' => array (
					'rule' => '/\d+\.\d{4,}/',
					'message' => 'scorm.rule.minimumpercent.decimal',
					'required' => false,
					'allowEmpty' => true
				),
				'GreaterEqual1' => array (
					'rule' => array('comparison', '>=', 0),
					'message' => 'scorm.rule.minimumpercent.range'
				),
				'LessEqual1' => array (
					'rule' => array('comparison', '<=', 1),
					'message' => 'scorm.rule.minimumpercent.range'
				),
			)
		);
	
	function save($data=null,$validate=true,$fields=array()) {
		$saved = parent::save($data,$validate,$fields);
		if($saved && isset($data['Rule'])) {
			foreach($data['Rule'] as $rule){ 
				$rule['rollup_id'] = $this->getLastInsertId();
				$rule['type'] = 'rollup';
				$this->Rule->create();
				$saved = $this->Rule->save(array('Rule'=>$rule));
				if(!$saved)
					break;
			}
		}
		return $saved;
	}
}
?>
