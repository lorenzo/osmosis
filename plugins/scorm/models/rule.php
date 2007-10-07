<?php
class Rule extends ScormAppModel {

	var $name = 'Rule';
	var $validate = null;

	function __construct() {
		parent::__construct();
		$this->validate = array(
			'type' => array (
				'rule' => '/(pre|post|exit|rollup)',
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
					'message' => 'scorm.condition.measurethreshold.decimal',
					'required' => false,
					'allowEmpty' => true
				),
				'GreaterEqual1' => array (
					'rule' => array('comparison', '>=', 0),
					'message' => 'scorm.condition.measurethreshold.range'
				),
				'LessEqual1' => array (
					'rule' => array('comparison', '<=', 1),
					'message' => 'scorm.condition.measurethreshold.range'
				),
			),
			'minimumCount' => array (
				'Number' => array (
					'rule' => '/\d+/',
					'message' => 'scorm.condition.measurethreshold.number',
					'required' => false,
					'allowEmpty' => true
				),
				'NonNegative' => array (
					'rule' => array('comparison', '>=', 0),
					'message' => 'scorm.condition.measurethreshold.nonegative'
				)
			),
		);
	}

	var $belongsTo = array(
		'Rollup' => array(
			'className' => 'Rollup',
			'foreignKey' => 'rollup_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);

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

}
?>
