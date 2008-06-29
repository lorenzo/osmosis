<?php
App::import('Component', 'PlaceholderData');
class LockerHolderComponent extends PlaceholderDataComponent {
	var $name = 'LockerHolder';
	var $auto = true;
	var $cache = true;
	
	function head() {
		$plugin_name = $this->controller->plugin;
		$controller = $this->controller;
		return $plugin_name == 'locker'
				|| ($controller->name=='Dashboards' && $controller->action == 'connections')
				|| $this->controller->name == 'Members' && $this->controller->action == 'view';
	}
	
	/**
	 * Set data to be used on the connectionsDashboard placeholder
	 *
	 * @return mixed Data or False if no data sent do placeholder
	 **/
	function connectionsDashboard() {
		$this->controller->helpers[] = 'Locker.Mime';
		$folder = ClassRegistry::init('Locker.LockerFolder', 'Model');
		$dropbox = $folder->dropbox(Configure::read('ActiveUser.Member.id'));
		$dropbox['Member']['id'] = Configure::read('ActiveUser.Member.id');
		return $dropbox;
	}
	
	function profileConnect() {
		return array('member_id' => $this->controller->Auth->user('id'));
	}
}
?>