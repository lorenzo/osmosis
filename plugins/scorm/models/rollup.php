<?php
class Rollup extends ScormAppModel {
	var $name = 'Rollup';
	var $validate = null;
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

	function __construct() {
		parent::__construct();
		$this->validate = array(
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
	}
	
	function save($data=null,$validate=true,$fields=array()) {
		$saved = parent::save($data,$validate,$fields);
		if($saved && isset($data['Rule'])) {
			foreach($data['Rule'] as $rule){
				$rule['rollup_id'] = $this->getLastInsertId();
				$this->Rule->create();
				$saved = $this->Rule->save($rule);
				if(!$saved)
					break;
			}
		}
		return $saved;
	}
}
?>
