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
class Rule extends ScormAppModel {

	var $name = 'Rule';
	var $useTable = 'scorm_rules';
  var $actsAs = array('transaction');
	var $validate = array(
			'type' => array (
				'rule' => '/(pre|post|exit|rollup)/',
				'message' => 'scorm.rule.type.allowedvalues',
				'required' => true,
				'allowEmpty' => false
			),
			'conditionCombination' => array (
				'rule' => '/(all|any)/',
				'message' => 'scorm.rule.conditioncombination.token',
				'allowEmpty' => true
			),
			'action' => array (
				'rule' => 'checkAllowedRules',
				'message' => 'scorm.rule.action.allowedvalues',
				'required' => true,
				'allowEmpty' => false
			),
			'minimumPercent' => array (
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
			),
			'minimumCount' => array (
				'Number' => array (
					'rule' => '/\d+/',
					'message' => 'scorm.rule.minimumcount.number',
					'required' => false,
					'allowEmpty' => true
				),
				'NonNegative' => array (
					'rule' => array('comparison', '>=', 0),
					'message' => 'scorm.rule.minimumcount.nonegative'
				)
			),
		);

	var $hasMany = array(
		'Condition' => array(
			'className' => 'Scorm.Condition',
			'foreignKey' => 'rule_id',
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
	
	function checkAllowedRules($value) {
		if(isset($this->data['Rule']))
			$type = $this->data['Rule']['type'];
		else 
			$type = $this->data['type'];
		$regexes = array (
			'pre' => '/(skip|disabled|hiddenFromChoice|stopForwardTraversal)/',
			'post' => '/(exitParent|exitAll|retry|retryAll|continue|previous)/',
			'exit' => '/exit/',
			'rollup' => '/satisfied|notSatisfied|completed|incomplete/'
		);
		return preg_match($regexes[$type], array_shift($value));
	}
	
	function save($data=null,$validate=true,$fields=array()) {
		$saved = parent::save($data,$validate,$fields);
		if($saved && isset($data['Rule']['Condition'])) {
			foreach($data['Rule']['Condition'] as $condition){
				$condition['rule_id'] = $this->getLastInsertId();
				$this->Condition->create();
				$saved = $this->Condition->save($condition);
				if(!$saved) {
					break;
				}
					
			}
		}	
		return $saved;
	}
	
	function beforeValidate() {
		if(isset($this->data['Action'])) {
			if(isset($this->data['Rule'])) {
				$this->data['Rule']['action'] = $this->data['Action']['action'];
			}
		}elseif(isset($this->data['Rule']['Action'])) {
			$this->data['Rule']['action'] = $this->data['Rule']['Action']['action'];
		} 
		unset($this->data['Rule']['Action']);
		return parent::beforeValidate();
	}

}
?>
