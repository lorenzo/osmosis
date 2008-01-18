<?php
class ChoiceConsideration extends ScormAppModel {

	var $name = 'ChoiceConsideration';
	var $useTable = 'scorm_choice_considerations';
	var	$validate = array(
			'preventActivation' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.choiseconsideration.preventactivation.boolean',
					'required' => false
				)
			),
			'constrainChoice' => array(
				'Boolean' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.choiseconsideration.constrainchoice.boolean',
					'required' => false
				)
			)
		);

}
?>
