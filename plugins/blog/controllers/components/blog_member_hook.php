<?php
class BlogMemberHookComponent extends Object{
	function beforeValidate() {
		// debug('hola!');	
		return true;
	}
	function afterSave(&$model, $created){
		// debug('AfterSave!');		
	}
	
}

?>