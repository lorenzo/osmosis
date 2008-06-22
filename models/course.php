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
 * Model Class that represents a Course.
 */
class Course extends AppModel {

	var $name = 'Course';
	var $validate = array(
		'department_id' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create'
	        )
		),
		'owner_id' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create'
			)
		),
		'code' => array(
			'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true
	        ),
			'maxlength' => array(
		        'rule'		=> array('maxlength',10),
				'required'	=> true,
				'allowEmpty'=> false
			)
		),
		'name' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
			),
			'maxlength' => array(
				'rule' => array( 'maxlength',150),
			)
		),
		'description' => array(
		    'empty' => array(
		        'rule' => array('custom','/.+/'),
		        'required' => true,
		        'on' => 'create',
			),
		)
	);
	
	/**
	 * BelongsTo (1-N) relation descriptors
	 *
	 * @var array
	 **/
	var $belongsTo = array(
		// Course BelongsTo Department
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		),
		// Course BelongsTo Member (Owner)
		'Owner' => array(
			'className' => 'Member',
			'foreignKey' => 'owner_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'counterCache' => ''
		)
	);
	
	/**
	 * HasAndBelongsToMany (N-N) relation descriptors
	 */
	var $hasAndBelongsToMany = array(
		// Course HABTM Plugin (Active Tools for the course)
		'Tool' => array(
			'className' => 'Plugin',
			'joinTable' => 'course_tools',
			'foreignKey' => 'course_id',
			'associationForeignKey' => 'plugin_id',
			'with' => 'CourseTool'
		)
	);
	
	/**
	 * Constructor of the class. Startups validation error messages with i18n.
	 */
	function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'department_id.empty',
			__('Please select a departement',true)
		);
		$this->setErrorMessage(
			'owner_id.empty',
			__('Please set the course owner',true)
		);
		$this->setErrorMessage(
			'code.maxlength',
			__('The length of this field should be less than 10',true)
		);
		$this->setErrorMessage(
			'name.empty',
			__('Please write the Course name',true)
		);
		$this->setErrorMessage(
			'name.maxlength',
			__('The lenght of the name should be lees than 150',true)
		);
		$this->setErrorMessage(
			'description.empty',
			__('Please write the course description',true)
		);
		parent::__construct($id,$table,$ds);
	}

	/**
	 * Manages member enrollment into the course.
	 * 
	 * @param int $member_id ID of the member to enroll.
	 * @param String $role Role that the member will be assigned in the course.
	 * @param int $course_id ID of the course to enroll the member.
	 * @return mixed On success data saved if its not empty or true, false on failure.
	 * @access public
	 */
	function enroll($member_id, $role = 'attendee', $course_id = null) {
		if (empty($this->id)) {
			return false;
		}
		$course_id = $this->id;
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		$data = array(
			'course_id' => $course_id,
			'member_id' => $member_id,
			'role_id'	=> array_pop($this->Member->Enrollment->roles($role, true))
		);
		return $this->Member->Enrollment->save($data);
	}	
	
	/**
	 * Determines wether a member is enrolled in a course.
	 * 
	 * @param int $member_id ID of the member.
	 * @param int $id ID of the course.
	 * @return boolean true if the member is enrolled in the course. 
	 */
	function alreadyEnrolled($member_id, $id) {
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		$courses = $this->Member->courses($member_id);
		$courses = Set::extract('/Course/id', $courses);
		return in_array($id, $courses);
	}
	
	/**
	 * Gets the professors of the course.
	 *
	 * @param int $id ID of the course.
	 * @return Array professors of the course.
	 * @author Joaquín Windmüller
	 */
	function professors($id) {
		return $this->enrolled($id, 'professor', true);
	}
	
	/**
	 * Returns the members enrolled in the course, grouped by role.
	 *
	 * @param int $id ID of the course
	 * @param mixed $role specific role (or roles) of the enrolled members. Null to get all entrolled members.
	 * @return Array members enrolled in the course
	 * @author Joaquín Windmüller
	 */	
	function enrolled($id, $role = null, $groupedByCourse = false) {
		$fields = array('Enrollment.member_id', 'Enrollment.role_id');
		$order = array('course_id, role_id ASC');
		$conditions = array('course_id' => $id);
		
		$this->bindModel(array('hasAndBelongsToMany' => array('Member')));
		$roles = $this->Member->Enrollment->roles($role);
		if ($roles) {
			$conditions['Enrollment.role_id'] = Set::extract('/Role/id', $roles);
			$roles = Set::combine($roles, '/Role/id', '/Role/role');
		}
		
		// if ($groupedByCourse) {
			$fields[] = 'course_id';
		// }
		$this->Member->Enrollment->contain('Member(id,full_name,email,phone)');
		$enrolled = $this->Member->Enrollment->find('all', compact('conditions', 'fields', 'order'));
		$members_by_role = array();	
		$members_by_course = array();
		foreach ($enrolled as $i => $member) {
			$enrollment = $member['Enrollment'];
			$member = $member['Member'];
			$role_name = $roles[$enrollment['role_id']];
			$members_by_role[$role_name][] = $members_by_course[$enrollment['course_id']][] = array('Member' => $member);
		}
		
		if (!$groupedByCourse) {
			return $members_by_role;
		} else {
			return $members_by_course;
		}
	}
}
?>