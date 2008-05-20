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
class Sco extends ScormAppModel {

	var $name = 'Sco';
	var $useTable = 'scorm_scos';
	var $hasMany = array(
			'SubItem' => array('className' => 'Scorm.Sco',
								'foreignKey' => 'parent_id',
								'dependent' => true),
			'Objective' => array('className' => 'Scorm.Objective',
								'foreignKey' => 'sco_id',
								'conditions' => 'Objective.primary = 0',
								'dependent' => true),
			'Rule' => array('className' => 'Scorm.Rule',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Presentation' => array('className' => 'Scorm.ScoPresentation',
								'foreignKey' => 'sco_id',
								'dependent' => true),
	);
	var $hasOne = array(
			'PrimaryObjective' => array('className' => 'Scorm.Objective',
								'foreignKey' => 'sco_id',
								'conditions' => 'PrimaryObjective.primary = 1',
								'dependent' => true),
			'Randomization' => array('className' => 'Scorm.Randomization',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Rollup' => array('className' => 'Scorm.Rollup',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Choice' => array('className' => 'Scorm.ChoiceConsideration',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Consideration' => array('className' => 'Scorm.RollupConsideration',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Control' => array('className' => 'Scorm.ControlMode',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'DeliveryControl' => array('className' => 'Scorm.DeliveryControl',
								'foreignKey' => 'sco_id',
								'dependent' => true)
	);
	var $actsAs = array('transaction');
	var $validate = array(
			'manifest' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.manifest.empty',
					'required' => true
				)
			),
			'organization' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.organization.empty',
					'required' => true
				)
			),
			'identifier' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.identifier.empty',
					'required' => true)
				),
			'title' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.title.empty',
					'required' => true
					)
				),
			'href' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.href.empty',
					'required' => false
					)
				),
			'completionThreshold' => array(
				'required' =>  array(
					'rule' => 'decimal',
					'message' => 'scormplugin.sco.completionthreshold.decimal',
					'required' => false,
					'allowEmpty' => true
					)
				),
			'isvisible' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.sco.isvisible.boolean',
					'required' => false
					)
				),
			'attemptLimit' => array(
				'required' =>  array(
					'rule' => 'numeric',
					'message' => 'scormplugin.sco.attemptlimit.integer',
					'required' => false
					)
				),
			'attemptAbsoluteDurationLimit' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.attemptabsolutedurationlimit.empty',
					'required' => false
					)
				),
			'dataFromLMS' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.datafromlms.empty',
					'required' => false,
					'allowEmpty' => true
					)
				),
			'scormType' => array(
				'required' =>  array(
					'rule' => '/(sco|asset)/',
					'message' => 'scormplugin.sco.scormtype.token',
					'required' => false
					)
				),
			'parameters' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.sco.parameters.empty',
					'required' => false
					)
				)
		);
	
	function save($data=null,$validate=true,$fields=array()) {
		$saved = parent::save($data,$validate,$fields);
		$organization = isset($data['Sco']) ? $data['Sco']['organization'] : $data['organization'];
		$manifest = isset($data['Sco']) ? $data['Sco']['manifest'] : $data['manifest'];
		$scorm = isset($data['Sco']) ? $data['Sco']['scorm_id'] : $data['scorm_id'];
		if($saved && !empty($data['Sequencing'])) {
			@$data['Objective'] = $data['Sequencing']['Objective'];
			@$data['Randomization'] = $data['Sequencing']['Randomization'];
			@$data['Rollup'] = $data['Sequencing']['RollupRule'];
			@$data['Choice'] = $data['Sequencing']['Choice'];
			@$data['Consideration'] = $data['Sequencing']['Consideration'];
			@$data['Objective'] = $data['Sequencing']['Objective'];
			@$data['Control'] = $data['Sequencing']['Control'];
			@$data['DeliveryControl'] = $data['Sequencing']['DeliveryControl'];
			@$data['Choice'] = $data['Sequencing']['Choice'];
			@$data['PrimaryObjective'] = $data['Sequencing']['Objective']['Primary'];
			@$data['Rule'] = $data['Sequencing']['SequencingRule'];
			unset($data['Objective']['Primary']);
		}
		if($saved && isset($data['PrimaryObjective'])) {
				$data['PrimaryObjective']['sco_id'] = $this->getLastInsertId();
				$data['PrimaryObjective']['primary'] = 1;
				$saved = $this->Objective->save($data['PrimaryObjective']);
		}
		if($saved && isset($data['Objective'])) {
			foreach($data['Objective'] as $objective){
				$objective['sco_id'] = $this->getLastInsertId();
				$this->Objective->create();
				$saved = $this->Objective->save($objective);
				if(!$saved)
					break;
			}
		}
		if($saved && isset($data['Randomization'])) {
				$data['Randomization']['sco_id'] = $this->getLastInsertId();
				$saved = $this->Randomization->save($data['Randomization']);
		}
		if($saved && isset($data['Rollup'])) {
			$data['Rollup']['sco_id'] = $this->getLastInsertId();
			$saved = $this->Rollup->save($data['Rollup']);
		}
		if($saved && isset($data['Choice'])) {
				$data['Choice']['sco_id'] = $this->getLastInsertId();
				$saved = $this->Choice->save($data['Choice']);
		}
		if($saved && isset($data['Consideration'])) {
				$data['Consideration']['sco_id'] = $this->getLastInsertId();
				$saved = $this->Consideration->save($data['Consideration']);
		}
		if($saved && isset($data['Control'])) {
				$data['Control']['sco_id'] =$this->getLastInsertId();
				$saved = $this->Control->save($data['Control']);
		}
		if($saved && isset($data['DeliveryControl'])) {
				$data['DeliveryControl']['sco_id'] = $this->getLastInsertId();
				$saved = $this->DeliveryControl->save($data['DeliveryControl']);
		}
		if(isset($data['Rule'])) {
			if(isset($data['Rule']['Pre'])) {
				$saved = $this->_saveRule($data['Rule']['Pre'],'pre');
			}
			if($saved && isset($data['Rule']['Post'])) {
				$saved = $this->_saveRule($data['Rule']['Post'],'post');
			}
			if($saved && isset($data['Rule']['Exit'])) {
				$saved = $this->_saveRule($data['Rule']['Exit'],'exit');
			}
		}
		if($saved && isset($data['Presentation'])) {
			foreach($data['Presentation'] as $p){
				$p['sco_id'] = $this->getLastInsertId();
				$this->Presentation->create();
				$saved = $this->Presentation->save($p);
				if(!$saved)
					break;
			}
		}
		// Here is the function's bottleneck
		if($saved && isset($data['SubItem'])) {
			foreach($data['SubItem'] as $sco){
				$sco['parent_id'] = $this->getInsertId();
				$sco['organization'] = $manifest;
				$sco['manifest'] = $manifest;
				$sco['scorm_id'] = $scorm;
				$sub = new Sco();
				$sub->useDbConfig = $this->SubItem->useDbConfig;
				$sub->tablePrefix = $this->SubItem->tablePrefix;
				$sub->primaryKey = $this->SubItem->primaryKey;
				$saved = $sub->save($sco);
				unset($sub);
				if(!$saved) 
					break;
			}
		}
		return $saved;
	}
	
	function _saveRule($data,$type) {
		$saved = true;
		foreach($data as $rule){
			$rule['type'] = $type;
			$rule['sco_id'] = $this->getLastInsertId();
			$this->Rule->create();
			$saved = $this->Rule->save(array('Rule'=>$rule));
			if(!$saved) {
				break;
			}
		}
		return $saved;
	}
	
}
?>
