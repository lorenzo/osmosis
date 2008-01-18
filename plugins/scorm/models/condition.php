<?php
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
		return preg_match($regex, $field);
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
