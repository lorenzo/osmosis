<?php
class Rule extends ScormAppModel {

	var $name = 'Rule';
	var $validate = null;
    var $actsAs = array('transaction');
	function __construct() {
		parent::__construct();
		$this->validate = array(
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
	}

	var $hasMany = array(
		'Condition' => array(
			'className' => 'Condition',
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
		$type = $this->data['Rule']['type'];
		$regexes = array (
			'pre' => '/(skip|disabled|hiddenFromChoice|stopForwardTraversal)/',
			'post' => '/(exitParent|exitAll|retry|retryAll|continue|previous)/',
			'exit' => '/exit/',
			'rollup' => '/satisfied|notSatisfied|completed|incomplete/'
		);
		return preg_match($regexes[$type], $value);
	}
	
	function save($data=null,$validate=true,$fields=array()) {
		$this->begin();
		$saved = parent::save($data,$validate,$fields);
		if($saved && isset($data['Condition'])) {
			foreach($data['Condition'] as $condition){
				$condition['parent_id'] = $this->getLastInsertId();
				$this->Condition->create();
				$saved = $this->Condition->save($condition);
				if(!$saved)
					break;
			}
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
