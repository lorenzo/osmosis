<?php
class BlogMemberHookComponent extends Object{
	function beforeValidate() {
		// debug('hola!');	
	}
	function afterSave(&$model, $created){
		// debug('AfterSave!');		
	}
	
}

?>