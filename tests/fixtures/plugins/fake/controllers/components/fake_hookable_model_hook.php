<?php
class FakeHookableModelHookComponent extends Object{
	
	function beforeValidate(&$model){
		$model->data['HookableModel']['model'] = 'AnotherModel';
		return true;
	}
	
	function beforeSave(&$model){
		$model->data['HookableModel']['newfield'] = 'a new field';
		return true;
	}
}

?>