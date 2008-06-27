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
class DepartmentsController extends AppController {

	var $name = 'Departments';
	var $helpers = array('Html', 'Form' );

	var $layouts = array(
		'index' => 'admin'
	);
	
	/**
	 * Lists available departments
	 *
	 * @author José Lorenzo
	 */
	
	function index() {
		$this->Department->recursive = 1;
		$this->set('departments', $this->paginate());
	}
	

	function admin_index() {
		$this->Department->recursive = 1;
		$this->set('departments', $this->paginate());
	}

	/**
	 * Shows information about a department and list its associated courses
	 *
	 * @param string $id 
	 */
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Department',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->Department->recursive = -1;
		$this->set('department', $this->Department->read(null, $id));
		$this->set('courses',$this->paginate($this->Department->Course,array('Course.department_id'=>$id)));
	}

	/**
	 * Adds a department to the database
	 *
	 */	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Department->create();
			if ($this->Department->save($this->data)) {
				$this->Session->setFlash(__('The Department has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Department could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
	}

	/**
	 * Edits the information of a department
	 *
	 * @param string $id department's id
	 */	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Department',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Department->save($this->data)) {
				$this->Session->setFlash(__('The Department has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Department could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Department->read(null, $id);
		}
	}

	/**
	 * Deletes a department
	 *
	 * @param string $id department's id
	 */	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Department',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Department->del($id)) {
			$this->Session->setFlash(sprintf(__('Department %s deleted',true),"# $id"), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
