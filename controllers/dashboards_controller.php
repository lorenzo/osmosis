<?php
class DashboardsController extends AppController {

	var $name = 'Dashboards';
	var $helpers = array('Html', 'Form');
	var $components = array('OsmosisComponents');
	var $uses = array('Role');
	
	function dashboard() {
		$role = $this->Role->field('role', array('id' => $this->Auth->user('role_id')));
		if ($role=='Admin') {
			$this->redirect(array('controller' => 'dashboards', 'action' =>'dashboard', 'admin' => true, 'plugin' => ''));
		} else {
			$this->redirect(array('controller' => 'dashboards', 'action' =>'user_dashboard', 'admin' => false, 'plugin' => ''));
		}
	}
	function admin_dashboard() {
	}
	
	function user_dashboard() {
		$this->layout = 'no_course';
		$this->set('courses', $this->OsmosisComponents->getUserCourses());
	}

}
?>