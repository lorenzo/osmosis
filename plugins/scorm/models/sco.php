<?php
class Sco extends ScormAppModel {

	var $name = 'Sco';
	var $validate = null;
	var $hasMany = array(
			'SubItem' => array('className' => 'Sco',
								'foreignKey' => 'parent_id',
								'dependent' => true),
			'Objective' => array('className' => 'Objective',
								'foreignKey' => 'sco_id',
								'conditions' => 'Objective.primary = 0',
								'dependent' => true),
			'Rule' => array('className' => 'Rule',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Presentation' => array('className' => 'ScoPresentation',
								'foreignKey' => 'sco_id',
								'dependent' => true),
	);
	var $hasOne = array(
			'PrimaryObjective' => array('className' => 'Objective',
								'foreignKey' => 'sco_id',
								'conditions' => 'PrimaryObjective.primary = 1',
								'dependent' => true),
			'Randomization' => array('className' => 'Randomization',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Rollup' => array('className' => 'Rollup',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Choice' => array('className' => 'ChoiceConsideration',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Consideration' => array('className' => 'RollupConsideration',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'Control' => array('className' => 'ControlMode',
								'foreignKey' => 'sco_id',
								'dependent' => true),
			'DeliveryControl' => array('className' => 'DeliveryControl',
								'foreignKey' => 'sco_id',
								'dependent' => true)
	);
	var $actsAs = array('transaction');
	function __construct() {
		parent::__construct();
		$this->validate = array(
			'manifest' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.manifest.empty', true),
					'required' => true
				)
			),
			'organization' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.organization.empty', true),
					'required' => true
				)
			),
			'identifier' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.identifier.empty', true),
					'required' => true)
				),
			'title' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.title.empty', true),
					'required' => true
					)
				),
			'href' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.href.empty', true),
					'required' => false
					)
				),
			'completionThreshold' => array(
				'required' =>  array(
					'rule' => 'decimal',
					'message' => __('scormplugin.sco.completionthreshold.decimal', true),
					'required' => false
					)
				),
			'isvisible' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.sco.isvisible.boolean', true),
					'required' => false
					)
				),
			'attemptLimit' => array(
				'required' =>  array(
					'rule' => 'numeric',
					'message' => __('scormplugin.sco.attemptlimit.integer', true),
					'required' => false
					)
				),
			'attemptAbsoluteDurationLimit' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.attemptabsolutedurationlimit.empty', true),
					'required' => false
					)
				),
			'dataFromLMS' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.datafromlms.empty', true),
					'required' => false
					)
				),
			'scormType' => array(
				'required' =>  array(
					'rule' => '/(sco|asset)/',
					'message' => __('scormplugin.sco.scormtype.token', true),
					'required' => false
					)
				),
			'parameters' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => __('scormplugin.sco.parameters.empty', true),
					'required' => false
					)
				)
		);
	}
	
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
				if(!$saved)
					break;
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
				if(!$saved)
					break;
		}
		if($saved && isset($data['Rollup'])) {
			$data['Rollup']['sco_id'] = $this->getLastInsertId();
			$saved = $this->Rollup->save($data['Rollup']);
			if(!$saved)
				break;
		}
		if($saved && isset($data['Choice'])) {
				$data['Choice']['sco_id'] = $this->getLastInsertId();
				$saved = $this->Choice->save($data['Choice']);
				if(!$saved)
					break;
		}
		/*if($saved && isset($data['Consideration'])) {
				$data['Consideration']['sco_id'] = $this->getLastInsertId();
				$saved = $this->Consideration->save($data['Consideration']);
				if(!$saved)
					break;
		}*/
		/*if($saved && isset($data['Control'])) {
				$data['Control']['sco_id'] =$this->getLastInsertId();
				$saved = $this->Control->save($data['Control']);
				if(!$saved)
					break;
		}*/
		/*if($saved && isset($data['DeliveryControl'])) {
				$data['DeliveryControl']['sco_id'] = $this->getLastInsertId();
				debug($this->getLastInsertId());
				$saved = $this->DeliveryControl->save($data['DeliveryControl']);
				if(!$saved)
					break;
		}*/
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
		/*if($saved && isset($data['Presentation'])) {
			foreach($data['Presentation'] as $p){
				$p['sco_id'] = $this->getLastInsertId();
				$this->Presentation->create();
				$saved = $this->Presentation->save($p);
				if(!$saved)
					break;
			}
		}*/
		// Here is the function's bottleneck
		if($saved && isset($data['SubItem'])) {
			foreach($data['SubItem'] as $sco){
				$sco['parent_id'] = $this->getInsertId();
				$sco['organization'] = $manifest;
				$sco['manifest'] = $manifest;
				$sco['scorm_id'] = $scorm;
				$this->SubItem = new Sco();
				$saved = $this->SubItem->save($sco);
				unset($this->SubItem);
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
