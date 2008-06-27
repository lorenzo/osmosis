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
 * Enrollment Model, handles a ternary relation between Member, Course and Role 
 * (Member role in each course)
 */
class Enrollment extends AppModel {
	var $name = 'Enrollment';
	var $useTable = 'courses_members';

	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Enrollment BelongsTo Member (Enrolled Member)
		'Member' => array('className' => 'Member', 'foreignKey' => 'member_id'),
		// Enrollment BelongsTo Course (Course in which the Member is enrolled)
		'Course' => array('className' => 'Course', 'foreignKey' => 'course_id'),
		// Enrollment BelongsTo Role (Role of the Member)
		'Role' => array('className' => 'Role', 'foreignKey' => 'role_id')
	);
	
	/**
	 * Finds roles through its readable name
	 *
	 * @param mixed $role Role name(s)
	 * @param string $just_ids Wether the function should return only the ids of the roles
	 * @return mixed Array of roles (or ids) if found, false otherwise
	 */
	function roles($role = 'all', $just_ids = false) {
		$this->Role->recursive = -1;
		if ($role=='all') {
			return $this->Role->find('all');
		}
		if (is_string($role)) {
			$role = array($role);
		}
		$role = array_map(array('Inflector', 'camelize'), $role);
		$roles = $this->Role->find('all', array('conditions' => compact('role')));
		if ($just_ids) {
			$roles = Set::extract('/Role/id', $roles);
		}
		return $roles;
	}
	
	/**
	 * Returns an array with the course-specific roles
	 *
	 * @return array roles
	 **/
	function enrollableRoles() {
		$this->Role->recursive = -1;
		$enrollable_roles = array('Attendee', 'Professor', 'Assistant');
		return $this->Role->find('all', array('conditions' => array('role' => $enrollable_roles)));
	}
}
?>