<?php
App::import('Model', 'Member');
class OsmosisComponentsComponent extends Object {
	
	var $controller;
	var $Member = null;
	
	function startup(&$controller) {
		$this->controller =& $controller;
		$this->Member =& new Member;
	}
	
	function getUserCourses(){
		if (!isset($this->controller->Auth)) {
			return;
		}
		$courses = $this->Member->courses($this->controller->Auth->user('id'));
		$this->controller->viewVars['Osmosis']['courseList'] = $courses;
	}
	
	function beforeRender() {
		$this->getUserCourses();
	}
}

?>