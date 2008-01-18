<?php
class RollupConsideration extends ScormAppModel {

	var $name = 'RollupConsideration';
	var $useTable = 'scorm_rollup_considerations';
	var $validate = array(
			'requiredForSatisfied' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredforsatisfied.token',
					'required' => false
				)
			),
			'requiredForNotSatisfied' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredfornotsatisfied.token',
					'required' => false
				)
			),
			'requiredForComplete' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredforcomplete.token',
					'required' => false
				)
			),
			'requiredForIncomplete' => array(
				'Token' =>  array(
					'rule' => 'ValidateToken',
					'message' => 'scormplugin.rollupconsideration.requiredforincomplete.token',
					'required' => false
				)
			),
			'measureSatisfactionIfActive' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.rollupconsideration.measuresatisfactionifactive.boolean',
					'required' => false
				)
			)
		);
	
function ValidateToken($field){
	$regex = ('/(always|ifAttempted|ifNotSkipped|ifNotSuspended)/');
	return preg_match($regex,$field);
	}
}
?>
