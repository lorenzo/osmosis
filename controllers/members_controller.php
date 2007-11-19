<?php
class MembersController extends AppController {

	var $name = 'Members';
	var $components = array('Auth');
	var $helpers = array('Html','Form');
	var $scaffold;
	
	/*
	* Logs an user into the sistem
	* @return void
	*/
	function login() {
		//Let the auth component manage login action
	}
	
	/**
	 * Logs an user out of the system and redirects him to the logout action set
	 * in AuthComponent
	 * @return void
	 */
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
}
?>