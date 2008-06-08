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
		if ($this->action == 'view') 
			$this->activeCourse = $this->params['pass'][0];
		else
			parent::_setActiveCourse();
	}

	/**
	 * Lists available courses
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function index() {
		$this->Course->recursive = 0;
		$this->set('courses', $this->paginate());
		$this->layout = 'no_course';
		$this->Placeholder->attach('plugin_updates');
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
	 * @author José Lorenzo
	 */
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('course', $this->Course->read(null, $id));
		$this->set('professors', $this->Course->professors($id));
	}

	/**
	 * Adds a new course
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Course->create();
			$this->data['Course']['owner_id'] = $this->Auth->user('id');
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.',true));
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
	 * @author José Lorenzo
	 */
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Course',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Course->save($this->data)) {
				$this->Session->setFlash(__('The Course has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Course could not be saved. Please, try again.',true));
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
	 * @author José Lorenzo
	 */
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Course'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Course->del($id)) {
			$this->Session->setFlash(sprintf(__('Course %s deleted',true),"# $id"));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

	/**
	 * Enrolls the logged member in the course with id $course_id
	 *
	 * @param string $course_id the course identifier
	 * @return void
	 * @author José Lorenzo
	 */
	
	function enroll($course_id) {
		$this->Course->id = $course_id;
		if (!$this->Course->exists()) {
			$this->Session->setFlash(__('Invalid Course',true));
			$this->redirect('/');
		}
		if($this->Course->alreadyEnrolled($this->Auth->user('id'), $course_id)===true) {
			$this->Session->setFlash(__('You have been already enrolled in this course',true));
			$this->redirect(array('action' => 'index'));
		} else if ($this->Course->enroll($this->Auth->user('id'))) {
			$this->Session->setFlash(__('You have been enrolled',true));
			$this->redirect(array('action' => 'view', $course_id));
		}
		$this->Session->setFlash(__('Enrollment failed',true));
		$this->redirect(array('action' => 'index'));
	}
	
	/**
	 * Adds or removes a tool from a course
	 *
	 * @param string $id course identifier
	 * @author José Lorenzo
	 */
	
	function tools($id) {
		if (!empty($this->data)) {
			if (isset($this->data['CourseTool']['add'])) {
				
				if ($this->Course->Tool->CourseTool->save($this->data))
					$this->Session->setFlash(__('The Tool has been added',true));
				else
					$this->Session->setFlash(__('The could not be added',true));
			} elseif (isset($this->data['CourseTool']['remove'])) {
				
				unset($this->data['CourseTool']['remove']);
				if ($this->Course->Tool->CourseTool->deleteAll($this->data['CourseTool']))
					$this->Session->setFlash(__('The Tool has been removed',true));
				else 
					$this->Session->setFlash(__('The Tool could not be removed',true));
			}
		}
		$tools = $this->Course->Tool->actives();
		$this->set(compact('tools','id'));
	}

}
?>
