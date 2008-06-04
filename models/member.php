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
				'required' => true
			)
		),
		'password' =>  array(
			'confirmation' => array(
				'rule' => array('confirmPassword')
			)
		),
		'password_confirm' => array(
			'required' => array(
				'rule' => 'alphanumeric',
				'required' => true
			)
		)
	);

	var $hasAndBelongsToMany = array(
		'Course' => array(
			'className' => 'Course',
			'joinTable' => 'courses_members',
			'foreignKey' => 'member_id',
			'associationForeignKey' => 'course_id',
			'with' => 'Enrollment',
			'unique' => true
		)
	);
	
    var $actsAs = array('Acl');

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
		parent::__construct($id, $table, $ds);
    }
    
    function parentNode() {
		return 2;
    }

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
	
	function isOnline($id) {
		$timeout = time() - (Security::inactiveMins() * Configure::read('Session.timeout'));
		return $this->find('first', array('conditions' => array('id' => $id, 'last_seen' => '< ' . $timeout )));
	}
	
	/**
	 * Validation function to check if the password and its confirmation are the same.
	 *
	 * @param array $data data sent
	 * @return boolean true if the passwords are the same
	 * @author Joaquín Windmüller
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
	 * @author Joaquín Windmüller
	 **/
	function isAdmin($username) {
		return $this->field('admin', compact('username'));
	}
	
	function members($course_id) {
		$members = $this->Enrollment->find('all', array(
			'conditions'=> array('course_id' => $course_id),
			'fields'	=> array('member_id')
		));
		return Set::extract('/Enrollment/member_id', $members);
	}
	
	function role($id,$course) {
		$this->Enrollment->bind('Role');
		$enrollment = $this->Enrollment->find('first', array('conditions' => array('course_id' => $course, 'member_id' => $id)));
		
		if (!empty($enrollment))
			return $enrollment['Role']['role'];
			
		return 'Member';
	}
		
}
?>