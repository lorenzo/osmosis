<?php
class ScoPresentation extends ScormAppModel {

	var $name = 'ScoPresentation';
	var $primaryKey = 'id';
	function __construct() {
		parent::__construct();
		$this->validate = array(
			'hideKey' => array(
				'Token' =>  array(
					'rule' => 'ValidateHidekeyToken',
					'message' => __('scormplugin.scopresentation.hidekey.token', true),
					'required' => false
				)
			),
		);
	}
	
	function ValidateHidekeyToken($field){
	$regex = ('/(previous|continue|exit|exitAll|abandon|abandonAll|suspendAll)/');
	return preg_match($regex,$field);
	}
}
?>