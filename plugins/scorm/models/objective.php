<?php
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
			'objectiveID' => array(
				'required' =>  array(
					'rule' => VALID_NOT_EMPTY,
					'message' => 'scormplugin.objective.objectiveid.empty',
					'required' => true,
				)
			),
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
