<?php
App::import('Component', 'PlaceholderData');

class ForumHolderComponent extends PlaceholderDataComponent {
	var $name = 'ForumHolder';
	var $auto = true;
	var $cache = false;
	var $types = array('head','course_toolbar');
	
	function getData($type = null) {
		if ($type == 'course_toolbar')
			return array('url' => array('plugin' => 'Forum', 'controller' => 'forums', 'action' => 'index'));
		elseif ($type == 'head') {
			return $this->controller->plugin == 'forum';
		}
		return false;
	}
}
?>