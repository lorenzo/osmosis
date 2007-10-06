<?php
class Randomization extends ScormAppModel {

	var $name = 'Sco';
	var $validate = null;
	var $primaryKey = 'id';
	var $table = 'randomizations';
	function __construct() {
		$this->validate = array(
			'randomizationTiming' => array(
				'required' =>  array(
					'rule' => 'validTiming',
					'message' => __('scormplugin.randomization.randomizationtiming.token', true),
					'required' => false,
				)
			),
			'selectCount' => array(
				'required' =>  array(
					'rule' => 'numeric',
					'message' => __('scormplugin.randomization.selectcount.integer', true),
					'required' => false
				)
			),
			'reorderChildren' => array(
				'required' =>  array(
					'rule' => IS_BOOLEAN,
					'message' => __('scormplugin.randomization.reorderchildren.empty', true),
					'required' => false)
				),
			'selectionTiming' => array(
				'required' =>  array(
					'rule' => 'validTiming',
					'message' => __('scormplugin.randomization.selectiontiming.token', true),
					'required' => false
					)
				)
		);
	}
	
	function validTiming($check) {
		return preg_match('/(never|once|onEachNewAttempt)/',$check);
	}
}
?>