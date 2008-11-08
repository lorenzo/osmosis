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
class CoursesController extends AppController {

	var $name = 'Courses';
	var $helpers = array('Html', 'Form','Rating','Javascript');
	
	function _setActiveCourse() {
		if (in_array($this->action,a('view','tools')) && isset($this->params['pass'][0])) 
			$this->activeCourse = $this->params['pass'][0];
		else
			parent::_setActiveCourse();
	}

	/**
	 * Lists available courses
	 *
	 * @return void
	 */
	
	function index() {
		$user_courses = $this->Course->Owner->courses($this->Auth->user('id'));
		$this->set('courses', $user_courses);
		$professors = array();
		if (!empty($user_courses)) {
			$professors = $this->Course->professors(Set::extract('/Course/id', $user_courses));
		}
		$this->layout = 'no_course';
		$this->Placeholder->attach('plugin_updates', $this->activeCourse);
		$this->set(compact('professors'));
	}

	function admin_index() {
		$this->Courses->recursive = 0;
		$this->set('courses', $this->paginate());
	}

	/**
	 * Displays course information
	 *
	 * @param string $id course id
	 * @return void
	 */
	function view($id = null) {
		$this->Placeholder->attach('course_dashboard', $this->activeCourse);
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('course', $this->Course->read(null, $id));
	}


	/**
	 * Displays course information
	 *
	 * @param string $id course id
	 * @return void
	 */
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('course', $this->Course->read(null, $id));
		$this->Course->bindModel(array('hasAndBelongsToMany' => array('Member')));
		$this->set('roles', $this->Course->Member->Enrollment->enrollableRoles());
		$this->set('enrolled', $this->Course->enrolled($id, array('attendee', 'assistant', 'professor')));
	}

	/**
	 * Adds a new course
	 *
	 * @return void
	 */
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Course->create();
			$this->data['Course']['owner_id'] = $this->Auth->user('id');
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		$departments = $this->Course->Department->find("list");
		$owners = $this->Course->Owner->find("list");
		$this->set(compact('departments', 'owners'));
	}

	/**
	 * Edits the information of a course
	 *
	 * @param string $id course id
	 * @return void
	 */
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Course',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Course->read(null, $id);
		}
		$departments = $this->Course->Department->find("list");
		$owners = $this->Course->Owner->find("list");
		$this->set(compact('departments', 'owners'));
	}

	/**
	 * Deletes a course
	 *
	 * @param string $id course id
	 * @return void
	 */
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course'), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Course->del($id)) {
			$this->Session->setFlash(sprintf(__('Course %s deleted',true),"# $id"), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

	/**
	 * Enrolls the logged member in the course with id $id
	 *
	 * @param string $id the course identifier
	 * @return void
	 */
	function enroll($id) {
		$this->__enroll($id, $this->Auth->user('id'));
	}
	
	/**
	 * Allows Admins to manually enroll users to courses
	 *
	 * @return void 
	 * @param int $id the course identifier 
	 * @param int $member_id the member id to enroll
	 **/
	function admin_enroll($id) {
		Configure::write('debug', 2);
		$success = false;
		$member = null;
		$role = 'attendee';
		if (isset($this->params['named']['role'])) {
			$role = $this->params['named']['role'];
		}
		if (!empty($this->data)) {
			$member_id = $this->data['Member']['id'];
			$success = $this->__enroll($id, $member_id, $role, false);
			$this->Course->Owner->recursive = -1;
			$member = $this->Course->Owner->read(array('id', 'full_name', 'username', 'institution_id'), $member_id);
			$member = $member['Owner'];
		}
		$this->set(compact('success', 'member'));
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 **/
	function __enroll($id, $member_id, $role = 'attendee', $redirect = true) {
		$this->Course->id = $id;
		if (!$this->Course->exists()) {
			$this->Session->setFlash(__('Invalid Course',true), 'default', array('class' => 'error'));
			$this->_redirectIf($redirect);
		}
		if($this->Course->alreadyEnrolled($member_id, $id)===true) {
			$this->Session->setFlash(__('You have been already enrolled in this course',true), 'default', array('class' => 'info'));
			$this->redirect(array('action' => 'view',$id));
		} else if ($this->Course->enroll($member_id, $role, $id)) {
			$this->Session->setFlash(__('You have been enrolled',true), 'default', array('class' => 'success'));
			if ($redirect) {
				$this->redirect(array('action' => 'view',$id));
			}
			return true;
		}
		$this->Session->setFlash(__('Enrollment failed',true), 'default', array('class' => 'error'));
		$this->_redirectIf($redirect, array('action' => 'index'));
		return false;
	}

	/**
	 * Adds or removes a tool from a course
	 *
	 * @param string $id course identifier
	 */
	function tools($id) {
		if (!empty($this->data)) {
			if (isset($this->data['CourseTool']['add'])) {
				
				if ($this->Course->Tool->CourseTool->save($this->data)) {
					$this->Session->setFlash(__('The Tool has been added',true), 'default', array('class' => 'success'));
				}	
				else
					$this->Session->setFlash(__('The could not be added',true), 'default', array('class' => 'error'));
			} elseif (isset($this->data['CourseTool']['remove'])) {

				unset($this->data['CourseTool']['remove']);
				if ($this->Course->Tool->CourseTool->deleteAll($this->data['CourseTool']))
					$this->Session->setFlash(__('The Tool has been removed',true), 'default', array('class' => 'success'));
				else 
					$this->Session->setFlash(__('The Tool could not be removed',true), 'default', array('class' => 'error'));
			}
		}
		$tools = $this->Course->Tool->actives(null,array('types' => 'tool'));
		$this->set(compact('tools','id'));
	}

}
?>