<?php
App::import('Component', 'PlaceholderData');

class ChatHolderComponent extends PlaceholderDataComponent {
	var $name = 'ChatHolder';
	var $auto = true;
	var $cache = false;
	var $types = array('head','course_sidebar');
	
	function getData($type = null) {
		if ($type == 'course_sidebar' || $type == 'head')
			return true;
		return false;
	}
}
?>