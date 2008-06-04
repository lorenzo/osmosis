<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
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
		$plugins = $this->actives(array('name', 'title','id'));
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
	 * Find a plugin depending on it's name
	 *
	 * @param string $name name to look for
	 * @param string $fields fields to be returned
	 * @param string $active active status of the plugin
	 * @return mixed
	 */
	
	function findByName($name,$fields = array(),$active = true) {
		return $this->find('first',array(
			'conditions'=>array(
				'name' => Inflector::camelize($name),
				'active' => $active
				),
			'fields' => $fields,'recursive' => -1));
	}
	
	/**
	 * Returns true if a plugin is intalled as a course tool
	 *
	 * @param string $id plugin id
	 * @param string $course_id course id
	 * @return boolean
	 */
	
	function isTool($id,$course_id) {
		return  $this->CourseTool->find('count',array(
			'conditions' => array(
				'plugin_id' => $id,
				'course_id'	=> $course_id
				),
			'recursive' => -1
			));
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
