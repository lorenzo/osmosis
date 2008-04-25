<?php
App::import('Component', 'PlaceholderData');

class ScormHolderComponent extends PlaceholderDataComponent {
	var $name = 'ScormHolder';
	var $auto = true;
	var $cache = false;
	var $types = array('course_toolbar');
	
	function getData($type = null) {
		if ($type == 'course_toolbar')
			return array('url' => array('plugin' => 'scorm', 'controller' => 'scorms', 'action' => 'index'));
		return false;
	}
}
?>