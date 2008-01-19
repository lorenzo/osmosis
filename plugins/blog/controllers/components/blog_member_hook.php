<?php
class BlogMemberHookComponent extends Object{
	
	function afterSave(&$model, $created){
		debug('AfterSave!');		
	}
	
}

?>