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
App::import('Core','Schema');
/**
 * Utilities to install plugins in the database
 *
 */

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
	 * Reads schema.php file from the calling plugin and denerates the tables specified in it
	 *
	 * @return boolean
	 */
	
	function createSchema($plugin = null) {
		if (!$plugin && isset($this->controller->plugin) && !empty($this->controller->plugin))
			$plugin = $this->controller->plugin;
		
		$instance = ClassRegistry::init('Plugin');
		$path = $instance->getPath($plugin);
		if (empty($path) || !($schema = new CakeSchema(array('name' => $plugin,'path' => $path.DS.'config'.DS.'sql'))))
			return false;
		
		$PluginSchema = $schema->load();
		
		if (!$PluginSchema)
			return true;
			
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
	
	/**
	 * Reads schema.php file from the calling plugin and drop the tables specified in it
	 *
	 * @param string $plugin 
	 * @return true on success
	 */
	
	function dropSchema($plugin) {
		$instance = ClassRegistry::init('Plugin');
		$path = $instance->getPath($plugin);
		if (empty($path) || !($schema = new CakeSchema(array('name' => $plugin,'path' => $path.DS.'config'.DS.'sql'))))
			return true;
			
		$PluginSchema = $schema->load();
		if (!$PluginSchema)
			return true;
			
		$db =& ConnectionManager::getDataSource('default');
		foreach ($PluginSchema->tables as $table => $fields) {
			$create[$table] = $db->dropSchema($PluginSchema, $table);
		}
		
		foreach($create as $table => $sql) {
			if (!empty($sql)) {
				if (!$db->_execute($sql)) {
					$this->errors[] = $db->lastError();
				}
			}
		}
		return empty($this->errors);
	}

}

?>
