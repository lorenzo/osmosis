<?php
class Rollup extends ScormAppModel {
	var $name = 'Rollup';
  var $actsAs = array('transaction');
	var $hasMany = array(
		'Rule' => array(
			'className' => 'Rule',
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
