<?php
class DashboardsController extends AppController {

	var $name = 'Dashboards';
	var $helpers = array('Html', 'Form');
	var $components = array('OsmosisComponents');
	var $uses = array();
	
	function admin_dashboard() {
	}
	
	function user_dashboard() {
		$this->layout = 'no_course';
		$this->set('courses', $this->OsmosisComponents->getUserCourses());
	}

}
?>