<?php
App::import('Component', 'PlaceholderData');

class WikiHolderComponent extends PlaceholderDataComponent {
	var $name = 'WikiHolder';
	var $auto = true;
	var $cache = false;
	
	function courseToolbar() {
		return array('url' => array(
			'plugin' => 'wiki', 
			'controller' => 'wikis',
			'action' => 'view', 
			'course_id' =>$this->controller->_getActiveCourse()));
	}
}
?>