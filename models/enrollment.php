<?php
class Enrollment extends AppModel {
	var $name = 'Enrollment';
	var $useTable = 'courses_members';
	
	var $belongsTo = array(
		'Role' => array('className' => 'Role', 'foreignKey' => 'role_id'),
		'Member' => array('className' => 'Member', 'foreignKey' => 'member_id'),
		'Course' => array('className' => 'Course', 'foreignKey' => 'course_id')
	);
	
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
	 * Returns an array with the roles related to enrollments.
	 *
	 * @return array roles
	 * @author Joaquín Windmüller
	 **/
	function enrollableRoles() {
		$this->Role->recursive = -1;
		$enrollable_roles = array('Attendee', 'Professor', 'Assistant');
		return $this->Role->find('all', array('conditions' => array('role' => $enrollable_roles)));
	}
}
?>