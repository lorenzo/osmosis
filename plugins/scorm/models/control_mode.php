<?php
class ControlMode extends ScormAppModel {

	var $name = 'ControlMode';
	var $validate = null;
	function __construct() {
		parent::__construct();
		$this->validate = array(
			'choiceExit' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.controlmode.choiceexit.boolean', true),
					'required' => false
				)
			),
			'choice' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.controlmode.choice.boolean', true),
					'required' => false
				)
			),
			'flow' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.controlmode.flow.boolean', true),
					'required' => false
				)
			),
			'forwardOnly' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.controlmode.forwardonly.boolean', true),
					'required' => false
				)
			),
			'useCurrentAttemptObjectiveInfo' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.controlmode.usecurrentattemptobjectiveinfo.boolean', true),
					'required' => false
				)
			),
			'useCurrentAttemptProgressInfo' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.controlmode.usecurrentattemptprogressinfo.boolean', true),
					'required' => false
				)
			)
		);
	}
}
?>