<?php
class DeliveryControl extends ScormAppModel {

	var $name = 'DeliveryControl';
	var	$validate = array(
			'tracked' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.deliverycontrol.tracked.boolean',
					'required' => false
				)
			),
			'completionSetByContent' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.deliverycontrol.completionsetbycontent.boolean',
					'required' => false
				)
			),
			'objectiveSetByContent' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.deliverycontrol.objectivesetbycontent.boolean',
					'required' => false
				)
			)
		);

}
?>
