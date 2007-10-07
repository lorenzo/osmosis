<?php
class DeliveryControl extends ScormAppModel {

	var $name = 'DeliveryControl';
	var $validate = null;
	function __construct() {
	parent::__construct();
		$this->validate = array(
			'tracked' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.deliverycontrol.tracked.boolean', true),
					'required' => false
				)
			),
			'completionSetByContent' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.deliverycontrol.completionsetbycontent.boolean', true),
					'required' => false
				)
			),
			'objectiveSetByContent' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.deliverycontrol.objectivesetbycontent.boolean', true),
					'required' => false
				)
			)
		);
	}
}
?>