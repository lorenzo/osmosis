<?php

class OsmosisComponentsComponent extends Object{
	
	function startup(&$controller){
		$this->controller =& $controller;
		$this->Member =& new Member;
	}
	
	function getUserCourses(){
		$ids = $this->Member->Enrollment->find('all',array(
			'conditions' => array(
					'member_id' => $this->controller->Auth->user('id')),
			'fields' => 'course_id'
			)
		);
		var_dump($ids);
		debug($ids);
	}
}

?>