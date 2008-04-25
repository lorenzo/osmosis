<?php
App::import('Component', 'PlaceholderData');

class WikiHolderComponent extends PlaceholderDataComponent {
	var $name = 'WikiHolder';
	var $auto = true;
	var $cache = false;
	var $types = array('course_toolbar');
	
	function getData($type = null) {
		if ($type == 'course_toolbar')
			return array('url' => array('plugin' => 'wiki', 'controller' => 'wikis', 'action' => 'view', $this->controller->activeCourse));
		return false;
	}
}
?>