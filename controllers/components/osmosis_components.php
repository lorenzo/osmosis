<?php
	App::import('Model', 'Member');

class OsmosisComponentsComponent extends Object{
	
	function startup(&$controller){
		$this->controller =& $controller;
		$this->Member =& new Member;
	}
	
	function getUserCourses(){
		$courses = $this->Member->courses($this->controller->Auth->user('id'));
		$this->controller->viewVars['Osmosis']['courseList'] = $courses;
	}
}

?>