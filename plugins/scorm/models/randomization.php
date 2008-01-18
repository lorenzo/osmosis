<?php
class Randomization extends ScormAppModel {

	var $name = 'Randomization';
	var $useTable = 'scorm_randomizations';
	var $validate = array(
			'randomizationTiming' => array(
				'required' =>  array(
					'rule' => 'validTiming',
					'message' => 'scormplugin.randomization.randomizationtiming.token',
					'required' => false,
				)
			),
			'selectCount' => array(
				'required' =>  array(
					'rule' => 'numeric',
					'message' => 'scormplugin.randomization.selectcount.integer',
					'required' => false
				)
			),
			'reorderChildren' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => 'scormplugin.randomization.reorderchildren.empty',
					'required' => false)
				),
			'selectionTiming' => array(
				'required' =>  array(
					'rule' => 'validTiming',
					'message' => 'scormplugin.randomization.selectiontiming.token',
					'required' => false
					)
				)
		);
	
	function validTiming($check) {
		return preg_match('/(never|once|onEachNewAttempt)/',$check);
	}
}
?>
