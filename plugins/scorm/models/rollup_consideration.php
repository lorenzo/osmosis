<?php
class RollupConsideration extends ScormAppModel {

	var $name = 'RollupConsideration';
	var $validate = null;
	function __construct() {
	parent::__construct();
		$this->validate = array(
			'requiredForSatisfied' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => __('scormplugin.rollupconsideration.requiredforsatisfied.token', true),
					'required' => false
				)
			),
			'requiredForNotSatisfied' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => __('scormplugin.rollupconsideration.requiredfornotsatisfied.token', true),
					'required' => false
				)
			),
			'requiredForComplete' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => __('scormplugin.rollupconsideration.requiredforcomplete.token', true),
					'required' => false
				)
			),
			'requiredForIncomplete' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => __('scormplugin.rollupconsideration.requiredforincomplete.token', true),
					'required' => false
				)
			),
			'measureSatisfactionIfActive' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.rollupconsideration.measuresatisfactionifactive.boolean', true),
					'required' => false
				)
			)
		);
	}
	
function ValidateToken($field){
	$regex = ('/(always|ifAttempted|ifNotSkipped|ifNotSuspended)/');
	return preg_match($regex,$field);
	}
}
?>