<?php
App::import('Component', 'PlaceholderData');

class AgendaHolderComponent extends PlaceholderDataComponent {
	var $name = 'AgendaHolder';
	var $auto = true;
	var $cache = false;
	
	function head() {
		return $this->controller->plugin == 'agenda' || ($this->controller->name == 'Courses' && $this->controller->action =='index');
	}
	
	function courseToolbar() {
		return array('url' =>
			array(
				'plugin'	=> 'agenda',
				'controller'=> 'events',
				'action'	=> 'index',
				'course_id' => $this->controller->_getActiveCourse()
			)
		);
	}
}	
?>