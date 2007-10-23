<?php
class ControlMode extends ScormAppModel {

	var $name = 'ControlMode';
	var	$validate = array(
			'choiceExit' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.controlmode.choiceexit.boolean',
					'required' => false
				)
			),
			'choice' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.controlmode.choice.boolean',
					'required' => false
				)
			),
			'flow' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.controlmode.flow.boolean',
					'required' => false
				)
			),
			'forwardOnly' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.controlmode.forwardonly.boolean',
					'required' => false
				)
			),
			'useCurrentAttemptObjectiveInfo' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.controlmode.usecurrentattemptobjectiveinfo.boolean',
					'required' => false
				)
			),
			'useCurrentAttemptProgressInfo' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.controlmode.usecurrentattemptprogressinfo.boolean',
					'required' => false
				)
			)
		);

}
?>
