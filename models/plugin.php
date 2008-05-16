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

	/**
	 * Returns the active plugins
	 *
	 * @param array $fields fields to retreive from plugin
	 * @param array $conditions search conditions as in Model::find
	 * @return array result as in Model::find
	 */
	
	function actives($fields=null,$conditions = array()) {
		$conditions = am($conditions,array('active' => 1));
		
		return $this->find('all',array('conditions' => $conditions, 'fields' => $fields, 'recursive' => 1));
	}
	
	/**
	 * Returns the inactive plugins
	 *
	 * @param array $fields fields to retreive from plugin
	 * @param array $conditions search conditions as in Model::find
	 * @return array result as in Model::find
	 */
	function inactives($fields=null,$conditions = array()){
		$conditions = am($conditions,array('active' => 0));
		
		return $this->find('all',array('conditions' => $conditions, 'fields' => $fields));
	}
	
	/**
	 * Returns all plugin folders stored in server
	 *
	 * @return array
	 */
	
	function inServer() {
		$stored = $this->getpluginPackages();
		
		return $stored;
	}
	
	/**
	 * Auxiliar function to retreive plugin folders in disk
	 *
	 * @return array
	 * @author José Lorenzo
	 */
	
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
	
	/**
	 * Adds a plugin folder to the database, an marks it as active
	 *
	 * @param string $plugin Folder name of the plugin
	 * @return boolean
	 * @author José Lorenzo
	 */
	
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
	
	/**
	 * Returns a list of objects from plugins that participates in placeholders based on a type
	 *
	 * @param string $type type of placeholder the objects participate
	 * @return array with reference to objects
	 * @author José Lorenzo
	 */
	
	function getHolders($type, $plugin = null) {
		
		if ($plugin) {
			$plugins = array(array('Plugin' => array('name' => $plugin)));
		} else {
			$plugins = $this->actives(array('name'));
		}
		$holders = array();
		foreach ($plugins as $plugin) {
			$className = $plugin['Plugin']['name'] . 'Holder';
			if (ClassRegistry::isKeySet($className.'Component') || App::import('Component',$plugin['Plugin']['name'] . '.' . $className)) {
				$class = $className. 'Component';
				if (ClassRegistry::isKeySet($class)) {
					$holderClass =& ClassRegistry::getObject($class);
				} else {
					$holderObject =& new $class;
					ClassRegistry::addObject($className,&$holderObject);
				}
					if (in_array($type,$holderObject->types) || method_exists($holderObject,Inflector::variable($type)))
						$holders[] = $holderObject;
			}
		}
		
		return $holders;
	}
	
	/**
	 * Returns a list of plugins with its correspondent PlaceholderData object if exists, if the plugin is associated
	 * to a Course with id $course_id
	 *
	 * @param string $course_id the course id associated to the tools
	 * @param boolean $fetchHolders tru to find PlaceholderData objects of plugin
	 * @return array list of plugins with correspondent holder object if any
	 */
	
	function getCourseTools($course_id, $fetchHolders = false) {
		$plugins = $this->actives(array('name', 'title','id'),array('types' => 'LIKE %tool%'));
		if ($fetchHolders) {
			if (is_array($fetchHolders) && isset($fetchHolders['type'])) {
				$type = $fetchHolders['type'];
			} elseif (is_string($fetchHolders))
				$type = $fetchHolders;
			else
				$type = 'course_toolbar';
		}
		$tools = array();
		foreach ($plugins as $plugin) {
			if (isset($plugin['Course']) && in_array($course_id, Set::extract($plugin,'Course.{n}.id'))) {
				if ($fetchHolders) {
					$holder = $this->getHolders($type, $plugin['Plugin']['name']);
					if(isset($holder[0])) {
						$plugin['Holder'] = $holder[0];
					} else
						$plugin['Holder'] = array();
				}
				unset($plugin['Course']);
				$tools[] = $plugin;
			}
				
		}

		return $tools;
	}
	
	/**
	 * Deconstruct the array of types an converts it to a comma separated string
	 *
	 * @see Model::deconstruct 
	 */
	
	function deconstruct($field, $value) {
		return implode(',',$value);
	}
	
	
}
?>