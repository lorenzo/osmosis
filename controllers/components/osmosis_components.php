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
class OsmosisComponentsComponent extends Overloadable {
	
	var $controller;
	
	function __get($var) {
		if ($var == 'Member') {
			$this->Member =& ClassRegistry::init('Member');
			return $this->Member;
		}
		return parent::__get($var);
	}
	
	function startup(&$controller) {
		$this->controller =& $controller;
	}
	
	function getUserCourses() {
		if (!isset($this->controller->Auth))
			return array();
		$member_id = $this->controller->Auth->user('id');
		if (!$member_id) {
			return array();
		}
		$courses = $this->Member->courses($member_id);
		$this->controller->viewVars['Osmosis']['courseList'] = $courses;
	}
	
	/**
	 * Sets to the view the professors of the active course
	 *
	 * @return void
	 **/
	function _setActiveCourseProfessors() {
		if (!$this->controller) return;
		$active_course = $this->controller->_getActiveCourse();
		if ($active_course) {
			$professors = $this->Member->Course->professors($active_course);
			$this->controller->viewVars['Osmosis']['active_course']['professors'] = array_pop($professors);
			$this->controller->viewVars['Osmosis']['active_course']['id'] = $active_course;
		}
	}
	
	/**
	 * Sets the current active user on the $Osmosis view Var
	 *
	 * @return void
	 **/
	function _setActiveMember() {
		if (!isset($this->controller->Auth))
			return array();
		$member = $this->controller->Auth->user();
		$this->controller->viewVars['Osmosis']['active_member'] = $member['Member'];
	}
	
	function beforeRender() {
		$this->_setActiveMember();
		$this->getUserCourses();
		$this->_setActiveCourseProfessors();
	}

}

?>
