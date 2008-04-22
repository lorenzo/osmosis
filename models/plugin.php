<?php
class Plugin extends AppModel {

	var $name = 'Plugin';
	var $validate = array(
		'name' => VALID_NOT_EMPTY,
		'active' => VALID_NOT_EMPTY,
	);
	
	var $hasAndBelongsToMany = array(
			'Course' => array(
				'className' => 'Course',
				'joinTable' => 'course_tools',
				'foreignKey' => 'plugin_id',
				'associationForeignKey' => 'course_id',
				'with' => 'CourseTool'
			)
	);

	function actives($fields=null,$conditions = array()) {
		$conditions = am($conditions,array('active' => 1));
		return $this->find('all',array('conditions' => $conditions, 'fields' => $fields));
	}
	
	function inactives($fields=null,$conditions = array()){
		$conditions = am($conditions,array('active' => 0));
		return $this->find('all',array('conditions' => $conditions, 'fields' => $fields));
	}
	
	function inServer() {
		$stored = $this->getpluginPackages();
		return $stored;
	}
	
	private function getpluginPackages() {
		$plugins = Configure::listObjects('plugin');
		Configure::load('plugin_descriptions');
		$result = array();
		foreach ($plugins as $plugin) {
			$result[$plugin] = Configure::read($plugin);
			unset($result[$plugin]['id'],$result[$plugin]['name'],$result[$plugin]['active']);
		}
		return $result;
	}
	
	function install($plugin) {
		if ($this->find('count',array('conditions' => array('name' => $plugin)))) {
			return false;
		}
		$stored = $this->inServer();
		
		if (!array_key_exists($plugin,$stored)) {
			return false;
		}
		$data = array('Plugin' => Set::merge($stored[$plugin],array('name' => $plugin, 'active' => 1)));
		return $this->save($data);
	}
	
	function deconstruct($field, $value) {
		return implode(',',$value);
	}
	
	
}
?>