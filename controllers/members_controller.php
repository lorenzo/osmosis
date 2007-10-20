<?php
class MembersController extends AppController {

	var $name = 'Members';
	var $components = array('Auth');
	var $helpers = array('Html','Form');
	var $scaffold;
	
	/*
	* Logs a user into the sistem
	*/
	function login() {
		//Let the auth component manage login action
	}
}
?>