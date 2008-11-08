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
/**
 * A Facade to attach various placeholders to a view
 *
 */
App::import('Model','Plugin');
class PlaceholderComponent extends Object {
	
	/**
	 * contains the list of objects that are responsible to sent placeholder data to the view
	 *
	 * @var array
	 */
	
	private $holders = array();
	
	/**
	 * Contains the name of the already attached placeholders
	 *
	 * @var string
	 */
	
	private $attached = array();
	
	
	
	/**
	 * Startup function. Sets the this component instance in the ClassRegistry for further use (Probably breaking some MVC rules)
	 *
	 * @param Controller $controller reference to the including controller
	 * @return void
	 */
	
	function startup(&$controller) {
		$this->controller =& $controller;		
		$this->started = true;
		// Sets this component instance in the class registry to be able to pull data from the view if needed
		ClassRegistry::addObject('Placeholder',&$this);
	}
	
	/**
	 * Adds a new placeholder type to the view
	 *
	 * @param mixed $types
	 * @return void
	 */
	
	function attach($types, $course_id = 0) {
		if (is_string($types)) {
			$types = array($types);
		}
		$holders = array();
		foreach ($types as $type) {
			if ($course_id == 0) {
				$holders[$type] = $this->getPlaceholderObjects($type);
			} else {
				$holders[$type] = $this->getPlaceholderObjects($course_id, true);
			}
		}
		$this->startupHolders($holders);
	}
	
	/**
	 * Adds a new toolbar placeholder to the view
	 *
	 * @param string $course_id the course id the toolbar belongs to
	 * @param string $type the name of the toolbar placeholder
	 * @return void
	 */
	
	function attachToolbar($course_id,$type = 'course_toolbar') {
		if ($type === 'course_toolbar') {
			$plugins = $this->getCourseToolbarObjects($course_id);
			$holders[$type] = array();
			foreach ($plugins as $plug) {
				if (!empty($plug['Holder'])) {
					$plug['Holder']->setConfig($type,array('title' => $plug['Plugin']['title']));
					$holders[$type][] = $plug['Holder'];
				}
			}
				$this->startupHolders($holders);
		} else {
			$this->attach($type);
		}
	}
	
	/**
	 * Initializes a list of PlaceholderData objects depending
	 *
	 * @param array $holders a list of references to objects indexed by type of placeholder
	 * @return void
	 */
	
	private function startupHolders($holders) {
		foreach ($holders as $type => $objects) {
			foreach ($objects as $object) {
				$name = $object->name;
				if (isset($this->controller->{$name})) {
					$this->{$name}->startup($this->controller, $type);
					continue;
				}	
				$this->controller->components[] = $name;
				$this->controller->{$name} = $object;
				$this->holders[$type][] = $name;
				$this->{$name} =& $this->controller->{$name};
				$this->{$name}->startup($this->controller, $type);
			}
			$this->attached[] = $type;
		}
	}
	
	/**
	 * Sends the data to th view just before rendering it, and if not sent automatically
	 *
	 * @return void
	 */
	
	function beforeRender() {
		foreach ($this->holders as $type => $objects) {
			foreach ($objects as $holder) {
				if (!$this->{$holder}->auto && !$this->{$holder}->_continue($type)) {
					$this->{$holder}->process($type);
				}
			}
		}
	}
	
	/**
	 * Finds and stores objects form plugins responsible for setting placeholder data to a view
	 *
	 * @param string $type the type of placeholder data objects to find
	 * @return array with references to objects
	 */
	
	private function getPlaceholderObjects($type){
		if (!isset($this->Plugin))
			$this->Plugin = new Plugin;
		return $this->Plugin->getHolders($type);
	}
	
	private function getCourseToolbarObjects($course_id) {
		if (!isset($this->Plugin))
			$this->Plugin = new Plugin;
		return $this->Plugin->getCourseTools($course_id,true);
	}
	
	/**
	 * Used by the view to pull data from the controller (Again breaking some rules)
	 *
	 * @param string $type type of placeholder data to return
	 * @return array
	 */
	
	public function pullData($type) {
		if (in_array($type, $this->attached)) {
			return array();
		}
		$this->attach($type);
		if (isset($this->controller->viewVars['placeholders'][$type]))
			return $this->controller->viewVars['placeholders'][$type];
		return array();
	}
	
}
?>
