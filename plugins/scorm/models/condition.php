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
class Condition extends ScormAppModel {

	var $name = 'Condition';
	var $useTable = 'scorm_conditions';
	var $belongsTo = array(
		'Rule' => array('className' => 'Scorm.Rule',
			'foreignKey' => 'rule_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);

	var	$validate = array(
			'referencedObjective' => array (
				'NotEmpty' => array (
					'rule' => 'objectiveExists',
					'message' => 'scorm.condition.referencedobjective.empty',
					'allowEmpty' => true
				)
			),
			'measureThreshold' => array (
				'Decimal' => array (
					'rule' => '/\-?\d+\.\d{4,}/',
					'message' => 'scorm.condition.measurethreshold.decimal',
					'required' => false,
					'allowEmpty' => true
				),
				'GreaterEqual1' => array (
					'rule' => array('comparison', '>=', -1),
					'message' => 'scorm.condition.measurethreshold.range'
				),
				'LessEqual1' => array (
					'rule' => array('comparison', '<=',  1),
					'message' => 'scorm.condition.measurethreshold.range'
				),
			),
			'operator' => array (
				'Token' => array (
					'rule' => '/(not|noOp)/',
					'message' => 'scorm.condition.operator.token'
				)
			),
			'ruleCondition' => array (
				'Token' => array (
					'rule' => 'validateConditionToken',
					'message' => 'scorm.condition.condition.token'
				)
			)
		);

	/**
	 * Validates the allowed values of the condition field.
	 */
	function validateConditionToken($field) {
		$regex = '/(satisfied|objectiveStatusKnown|objectiveMeasureKnown|objectiveMeasureGreaterThan|objectiveMeasureLessThan|completed|activityProgressKnown|attempted|attemptLimitExceeded|timeLimitExceeded|outsideAvailableTimeRange|always)/';
		return preg_match($regex, array_shift($field));
	}
	
	// TODO
	function objectiveExists($value) {
		return true;
	}
	
	function beforeValidate() {
		if(isset($this->data['Condition']['condition'])) {
			$this->data['Condition']['ruleCondition'] = $this->data['Condition']['condition'];
		}
		return parent::beforeValidate();
	}
}
?>
