<?php
class Condition extends AppModel {

	var $name = 'Condition';
	var $validate = null;

	var $belongsTo = array(
		'Rule' => array('className' => 'Rule',
			'foreignKey' => 'rule_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);

	function __construct() {
		parent::__construct();
		$this->validate = array(
			'referencedObjective' => array (
				'NotEmpty' => array (
					'rule' => 'objectiveExists',
					'message' => 'scorm.condition.referencedobjective.empty',
					'allowEmpty' => true
				)
			),
			'measureThreshold' => array (
				'Decimal' => array (
					'rule' => '/\d+\.\d{4,}/',
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
			'condition' => array (
				'Token' => array (
					'rule' => 'validateConditionToken',
					'message' => 'scorm.condition.condition.token'
				)
			)
		);
	}

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
}
?>
