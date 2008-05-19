<?php
App::import('Core','Schema');
class InstallerComponent extends Object {
	var $controller;
	var $errors  = array();
	
	/**
	 *Stores the reference to the calling controller in $this->controller
	 * 
	 * @param Controller $controller 
	 * @return void
	 */
	
	function startup(&$controller) {
		$this->controller =& $controller;
	}
	
	/**
	 * Reads schema.php file from the calling plugin and enerates the tables specified in it
	 *
	 * @return boolean
	 */
	
	function createSchema() {
		if (isset($this->controller->plugin) && !empty($this->controller->plugin))
			$plugin = $this->controller->plugin;
		else 
			return false;
		$configure = Configure::getInstance();
		$pluginPaths = $configure->pluginPaths;
		$path = '';
		foreach ($pluginPaths as $pp) {
			if (is_dir($pp.Inflector::underscore($plugin))) {
				$path = $pp.Inflector::underscore($plugin);
				break;
			}	
		}
		if (empty($path) || !($schema = new CakeSchema(array('name' => $plugin,'path' => $path.DS.'config'.DS.'sql'))))
			return false;
		
		$PluginSchema = $schema->load();
		$db =& ConnectionManager::getDataSource('default');
		foreach ($PluginSchema->tables as $table => $fields) {
			$create[$table] = $db->createSchema($PluginSchema, $table);
		}
		
		foreach($create as $table => $sql) {
			if (!empty($sql)) {
				if (!$schema->before(array('create' => $table))) {
					continue;
				}
				if (!$db->_execute($sql)) {
					$this->errors[] = $db->lastError();
				}
				$schema->after(array('create' => $table, 'errors'=> $this->errors));
			}
		}
			
		return empty($this->errors);
	}

}

?>