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
class Member extends AppModel {
	var $name = 'Member';
	var $displayField = 'full_name';

	/**
	 * Validation Rules for Fields
	 *
	 * @var array
	 **/
	var $validate = array(
		'full_name' => array(
			'required' => array(
				'rule' => array('custom', '/.+/')
			)
		),
		'email' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'last' => true
			),
			'valid' => array(
				'rule' => 'email'
			)
		),
		'username' =>  array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'last' => true
			),
			'unique' => array(
				'rule' => array('validateUnique', 'username'),
				'required' => true,
				'on'	=> 'create'
			)
		),
		'password' =>  array(
			'confirmation' => array(
				'rule' => array('confirmPassword'),
				'required' => false
			)
		),
		'password_confirm' => array(
			'required' => array(
				'rule' => array('custom', '/.+/'),
				'required' => false
			)
		),
		'question' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'on' => 'update'
			)
		),
		'answer' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'on' => 'update'
			)
		)
	);

	/**
	 * HasAndBelongsToMany (N-N) relation descriptors
	 *
	 * @var array
	 **/
	var $hasAndBelongsToMany = array(
		// Member HasAndBelongsToMany Course (Member enrollments in courses)
		'Course' => array(
			'className'				=> 'Course',
			'joinTable'				=> 'courses_members',
			'foreignKey'			=> 'member_id',
			'associationForeignKey'	=> 'course_id',
			'with'					=> 'Enrollment',
			'unique'				=> true
		)
	);

	/**
	 * Model contructor. Initializes the validation error messages with i18n
	 *
	 * @see Model::__construct
	 */
    function __construct($id = false, $table = null, $ds = null) {
		$this->setErrorMessage(
			'full_name.required',
			__('Please write your full name',true)
		);
		$this->setErrorMessage(
			'email.valid',
			__('Please write a valid email address',true)
		);
		$this->setErrorMessage(
			'email.required',
			__('Please write your email address',true)
		);
		$this->setErrorMessage(
			'username.required',
			__('Please write your username',true)
		);
		$this->setErrorMessage(
			'username.unique',
			__('This username is taken',true)
		);
		$this->setErrorMessage(
			'password.confirmation',
			__('The password and its confirmation do not match',true)
		);
		$this->setErrorMessage(
			'password_confirm.required',
			__('Please confirm the password',true)
		);
		$this->setErrorMessage(
			'question.required',
			__('Please select a security question',true)
		);
		$this->setErrorMessage(
			'answer.required',
			__('Please write your security answer',true)
		);
		$this->_findMethods = $this->_findMethods + array('usernameOrEmail' => true);
		parent::__construct($id, $table, $ds);
    }

	/**
	 * Returns the courses that a member is enrolled in
	 *
	 * @param mixed $id ID or array of Id's of members
	 * @return mixed data on success, false otherwise
	 */
	function courses($id) {
		$ids = $this->Enrollment->find('all',
			array(
				'conditions'=> array('member_id' => $id),
				'fields'	=> array('course_id')
			)
		);
		$ids = Set::extract($ids,'{n}.Enrollment.course_id');
		if (empty($ids)) {
			return array();
		}
		$courses = $this->Course->find('all', array(
			'conditions'=> array('id' => $ids),
			'fields'	=> array('id','code', 'name'),
			'recursive' => -1
			)
		);
		return $courses;
	}

	/**
	 * Determines if a member is online
	 *
	 * @param string $id ID of the member
	 * @return mixed data of the member or false on failure
	 * @todo Not really in use, MemberController::online could.
	 * @deprecated Not really in user
	 */
	function isOnline($id) {
		$timeout = time() - (Security::inactiveMins() * Configure::read('Session.timeout'));
		return $this->find('first', array('conditions' => array('id' => $id, 'last_seen' => '< ' . $timeout )));
	}
	
	/**
	 * Validation function to check if the password and its confirmation are the same.
	 *
	 * @param array $data data sent
	 * @return boolean true if the passwords are the same
	 */
	function confirmPassword($data) {
		$valid = false;
		if ($data['password'] == Security::hash(Configure::read('Security.salt') . $this->data['Member']['password_confirm'])) {
		   $valid = true;
		}
		return $valid;
	}
	
	/**
	 * Determines wether this user is administrator
	 *
	 * @return boolean
	 **/
	function isAdmin($username) {
		return $this->field('admin', compact('username'));
	}

	/**
	 * Returns the members enrolled in a course
	 *
	 * @param string $course_id Id of the course_id
	 * @return array members enrolled
	 */
	function members($course_id) {
		$members = $this->Enrollment->find('all', array(
			'conditions'=> array('course_id' => $course_id),
			'fields'	=> array('member_id')
		));
		return Set::extract('/Enrollment/member_id', $members);
	}

	/**
	 * Returns the role of the Member in a course
	 *
	 * @param string $id ID of the member
	 * @param string $course ID of the course
	 * @return string role name
	 */
	function role($id, $course) {
		$role = Cache::read('Member.Role.'.$id.'.'.$course);
		if (!$role) {
			$this->Enrollment->bind('Role');
			$conditions = array('course_id' => $course, 'member_id' => $id);
			$fields = array('Role.role');
			// TODO: use Model::field instead
			$enrollment = $this->Enrollment->find('first', compact('conditions','fields'));

			if (!empty($enrollment))
				$role = $enrollment['Role']['role'];
			else 
				$role =  'Member';
			Cache::write('Member.Role.'.$id.'.'.$course,$role,'60');
		}
		return $role;
	}
	
	/**
	 * Returns if $a has mor access priviledges than $b as a typical comparator that returns 0, 1 and -1
	 *
	 * @param string $a Human readable role name
	 * @param string $b Human readable role name
	 * @return int
	 * @see Role
	 */
	function compareRoles($a,$b) {
		$this->Enrollment->bind('Role');
		return $this->Enrollment->Role->compare($a,$b);
	}
	
	/**
	 * Custom find function that searches for a value in email or username.
	 *
	 * @param string $state 
	 * @param string $query 
	 * @param string $results 
	 * @return void
	 * @see Model::find
	 */
	function _findUsernameOrEmail($state, $query, $results = array()) {
		if ($state == 'before') {
			$value = $query['conditions'];
			$query['conditions'] = array('or' => array('username' => $value, 'email' => $value));
			$query['recursive'] = -1;
			$query['limit'] = 1;
			return $query;
		}
		if (!empty($results)) {
			$results = $results[0];
		}
		return $results;
	}
	
	function beforeSave() {
		if (isset($this->data['Member']['answer'])) {
			$this->data['Member']['answer'] = Security::hash($this->data['Member']['answer']);
			return $this->data;
		}
		return true;
	}
}
?>