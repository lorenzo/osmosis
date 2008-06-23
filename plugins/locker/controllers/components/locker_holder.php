<?php
App::import('Component', 'PlaceholderData');
class LockerHolderComponent extends PlaceholderDataComponent {
	var $name = 'LockerHolder';
	var $auto = true;
	var $cache = false;
	
	function head() {
		$plugin_name = $this->controller->plugin;
		$controller = $this->controller;
		return $plugin_name == 'locker' || ($controller->name=='Dashboards' && $controller->action == 'connections');
	}
	
	/**
	 * Set data to be used on the connectionsDashboard placeholder
	 *
	 * @return mixed Data or False if no data sent do placeholder
	 **/
	function connectionsDashboard() {
		$folder = ClassRegistry::init('LockerFolder');
		$conditions = array(
			'member_id'	=> Configure::read('ActiveUser.Member.id'),
			'parent_id'	=> null
		);
		$locker_id = $folder->field('id', $conditions);
		$conditions['name'] = 'dropbox';
		$conditions['parent_id'] = $locker_id;
		$fields = array('id', 'name', 'parent_id');
		$folder->recursive = 2;
		$data = $folder->find('first', compact('conditions', 'fields'));
		if (!$data) $data = true;
		return $data;
	}
}
?>
