<?php
class ScoPresentation extends ScormAppModel {

	var $name = 'ScoPresentation';
	var $primaryKey = 'id';
	var $validate = array(
			'hideKey' => array(
				'Token' =>  array(
					'rule' => 'ValidateHidekeyToken',
					'message' => 'scormplugin.scopresentation.hidekey.token',
					'required' => false
				)
			),
		);
	
	function ValidateHidekeyToken($field){
	$regex = ('/(previous|continue|exit|exitAll|abandon|abandonAll|suspendAll)/');
	return preg_match($regex,$field);
	}
}
?>
