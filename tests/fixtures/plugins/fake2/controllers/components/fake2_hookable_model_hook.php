<?php
class Fake2HookableModelHookComponent extends Object{
	
	function beforeValidate(&$model){
		$model->data['HookableModel']['locale'] = 'esp';		
		return true;
	}
	
	function beforeSave(&$model){
		$model->data['Assoc']['title'] = 'a new assoc';
		return true;
	}
	
}

?>