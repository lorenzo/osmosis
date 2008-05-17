<?php
class DashboardsController extends AppController {

	var $name = 'Dashboards';
	var $helpers = array('Html', 'Form');
	var $components = array('OsmosisComponents');
	var $uses = array('Role');
	
	function admin_dashboard() {
	}


}
?>