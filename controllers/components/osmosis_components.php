<?php
App::import('Model', 'Member');
class OsmosisComponentsComponent extends Object {
	
	var $controller;
	
	function startup(&$controller) {
		$this->controller =& $controller;
	}
	
	function getUserCourses() {
		if (!isset($this->controller->Auth))
			return array();
		$member = new Member;
		$courses = $member->courses($this->controller->Auth->user('id'));
		$this->controller->viewVars['Osmosis']['courseList'] = $courses;
	}
	
	function beforeRender() {
		$this->getUserCourses();
	}

}

?>