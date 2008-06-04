<?php
class OsmosisPermissions extends Object {
	var $Courses = array(
			'index'	=> 'Member',
			'view'	=> 'Member',
			'enroll' => 'Member',
			'tools'	=> 'Professor'
		);
	var $Departments = array(
			'index'	=> 'Public',
			'view'	=> 'Public'
		);
	var $Dashboards = array();
	var $Members = array(
			'view'	=> 'Member',
			'edit'	=> 'Member'
		);
}
?>