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
class MembersController extends AppController {

	var $name = 'Members';
	var $helpers = array('Html', 'Form');
	var $uses = array('Member');

	function admin_index() {
		$this->Member->recursive = 0;
		$conditions = array();
		if ($this->RequestHandler->prefers('json')) {
			if (isset($this->params['url']['q'])) {
				$conditions['full_name like'] = $this->params['url']['q'] . '%';
			}
			if (isset($this->params['named']['course_id'])) {
				$conditions['not'] = array('id' => $this->Member->members($this->params['named']['course_id']));
			}
			if (isset($this->params['named']['role'])) {
				$conditions['Role.id'] = $this->params['named']['role'];
			}
			$fields = array('id', 'username', 'full_name', 'institution_id');
			$this->set('members', $this->Member->find('all', compact('conditions', 'fields')));
		} else {
			$this->set('members',$this->paginate());
		}
		
	}

	/**
	 * Display the details of a member
	 *
	 * @param string $id 
	 * @return void
	 */
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Member.',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('member', $this->Member->read(null, $id));
	}

	/**
	 * Creates a new member
	 *
	 * @return void
	 */
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Member->create();
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
			unset($this->data['Member']['password']);
			unset($this->data['Member']['password_confirm']);
		}
		$this->set(compact('roles'));
	}

	/**
	 * Edit the details of a member
	 *
	 * @param string $id 
	 * @return void
	 */
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Member',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Member->read(null, $id);
		}
	}

	/**
	 * Deletes a member
	 *
	 * @param string $id 
	 * @return void
	 */
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Member',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Member->del($id)) {
			$this->Session->setFlash(__('Member deleted',true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	/*
	* Logs an user into the system
	* @return void
	*/
	function login() {
		//Let the auth component manage login action
		$this->set('isLogin', true);
	}
	
	/**
	 * Logs an user out of the system and redirects him to the logout action set
	 * in AuthComponent
	 * @return void
	 */
	function logout() {
		$action = $this->Auth->logout();
		$this->Session->destroy();
		$this->redirect($action);
	}
	
	function isAuthorized() {
		if ($this->action == 'logout' || $this->action == 'login') {
			return true;
		}
		return parent::isAuthorized();
	}
	
	/**
	 * Manage manual enrollments
	 *
	 * @return void
	 **/
	function admin_enroll() {
		$this->Member->recursive = 0;
		$this->set('members', $this->paginate());
	}
	
	/**
	 * Special treatment for login action when the member loging in is an admin
	 *
	 * @return void
	 */
	function _initializeAuth() {
		parent::_initializeAuth();
		if ($this->action =='login' && !empty($this->data) && $this->Member->isAdmin($this->data['Member']['username'])) {
			// die('jo');
			$this->Auth->loginRedirect = array('controller' => 'dashboards', 'action' => 'dashboard', 'admin' => true);
		}
	}
	
	/**
	 * Generates a list of online members known to the actual active member
	 *
	 * @return void
	 **/
	function online() {
		$active_member = $this->Auth->user('id');
		$active_course = $this->_getActiveCourse();
		$active_course_classmates = $this->Member->Course->find(
			'enrolled', 
			array(
				'course_id'	=> $active_course,
				'by'		=> 'course',
				'conditions' => array('member_id <>' => $active_member),
				'contain'	=> array('Member' => array('id', 'full_name', 'last_seen'))
			)
		);
		$active_course_classmates = array_pop($active_course_classmates);
		if (count($active_course_classmates) < 10) {
			$conditions = array('course_id <>' => $active_course, 'member_id' => $active_member);
			$fields = array('course_id');
			$my_courses = $this->Member->Enrollment->find('all', compact('conditions', 'fields'));
			$my_courses = Set::extract('/Enrollment/course_id', $my_courses);
			$ids_me = $ids = Set::extract('/Member/id', $active_course_classmates);
			$ids_me[] = $active_member;
			$classmates = $this->Member->Course->find(
				'enrolled',
				array(
					'course_id'		=> $my_courses,
					'conditions'	=> array('NOT' => array('member_id' => $ids_me)),
					'by'			=> 'course',
					'contain'		=> array('Member' => array('id', 'full_name', 'last_seen'))
				)
			);
			foreach ($classmates as $course_id => $members) {
				foreach ($members as $i => $member) {
					if (!in_array($member['Member']['id'], $ids_me)) {
						$active_course_classmates[] = $member;
					}
				}
			}
			$classmates = array(
				'Online'	=> array(),
				'Offline'	=> array(),
				'Away'		=> array()
			);
			$time = time();
			$timeout = (Security::inactiveMins() * Configure::read('Session.timeout'))/60;
			foreach ($active_course_classmates as $i => $member) {
				$minus = ($time - $member['Member']['last_seen'])/60;
				$member['Member']['timeout'] = $minus;
				if ($minus >= 0 && $minus < 5) {
					$classmates['Online'][] = $member;
				} else if ($minus >= 5 && $minus < $timeout) {
					$classmates['Away'][] = $member;
				} else if ($minus >= $timeout) {
					$classmates['Offline'][] = $member;
				} else {
					$classmates['???'][] = $member;
				}
			}
		}
		// debug($classmates);die;
		$this->set(compact('classmates'));
	}
}
?>