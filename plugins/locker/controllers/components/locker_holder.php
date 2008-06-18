<?php
App::import('Component', 'PlaceholderData');
class LockerHolderComponent extends PlaceholderDataComponent {
	var $name = 'LockerHolder';
	var $auto = true;
	var $cache = false;
	
	function head() {
		return $this->controller->plugin == 'locker';
	}
	
	/**
	 * 
	 *
	 * @return void
	 **/
	function connectionsDashboard() {
		return true;
	}
}
?>
