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
	var $helpers = array('Html', 'Form' );
	var $uses = array('Member');
	/**
	 * Lists available members
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function index() {
		$this->Member->recursive = 0;
		$this->set('members', $this->paginate());
	}

	function admin_index() {
		$this->Member->recursive = 0;
		$conditions = array();
		if (isset($this->params['named']['role'])) {
			$conditions['Role.id'] = $this->params['named']['role'];
		}
		$this->set('members', $this->paginate(null, $conditions));
	}

	/**
	 * Display the details of a member
	 *
	 * @param string $id 
	 * @return void
	 * @author José Lorenzo
	 */
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Member.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('member', $this->Member->read(null, $id));
	}

	/**
	 * Creates a new member
	 *
	 * @return void
	 * @author José Lorenzo
	 */
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Member->create();
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.',true));
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
	 * @author José Lorenzo
	 */
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Member',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Member->save($this->data)) {
				$this->Session->setFlash(__('The Member has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Member could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Member->read(null, $id);
		}
		$roles = $this->Member->Role->find('list');
		$this->set(compact('roles'));
	}

	/**
	 * Deletes a memeber
	 *
	 * @param string $id 
	 * @return void
	 * @author José Lorenzo
	 */
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Member',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Member->del($id)) {
			$this->Session->setFlash(__('Member #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	/*
	* Logs an user into the system
	* @return void
	*/
	function login() {
		//Let the auth component manage login action
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
	 * @author Joaquín Windmüller
	 **/
	function admin_enroll() {
		$this->Member->recursive = 0;
		$this->set('members', $this->paginate());
	}

}
?>
