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
class FoldersController extends LockerAppController {

	var $name = 'Folders';
	var $helpers = array('Html', 'Form');
	var $uses = array('Locker.LockerFolder');
	
	function _ownerAuthorization() {
		if($this->action == 'view')
			return parent::_ownerAuthorization();
			
		switch ($this->action) {
			case 'view' :
				return true;
			case 'add' :
				if (isset($this->data['LockerFolder']['parent_id']))
					return $this->LockerFolder->isOwner($this->Auth->user('id'),$this->data['LockerFolder']['parent_id']);
				break;
			case 'edit' :
			case 'move' :
			case 'delete' :
				if (isset($this->data['LockerFolder']['id']))
					return $this->LockerFolder->isOwner($this->Auth->user('id'),$this->data['LockerFolder']['id']);
				
				if (isset($this->params['pass'][0]))
					return $this->LockerFolder->isOwner($this->Auth->user('id'),$this->params['pass'][0]);
				break;
		}
			
		return false;
	}


	function view($id = null) {
		$member = $parentFolder = $path = null;
		if (!$id) {
			if (!isset($this->params['named']['member_id'])) {
				$this->Session->setFlash(__('Invalid Locker', true), 'default', array('class' => 'error'));
				$this->redirect('/');
			} else {
				$member_id = $this->params['named']['member_id'];
				$id = $this->LockerFolder->userLocker($member_id, true);
			}
		}
		$this->LockerFolder->contain('Member(username,full_name)', 'SubFolder', 'Document');
		$parentFolder = $this->LockerFolder->read(null, $id);
		$this->_redirectIf(!$parentFolder);
		$path = $this->LockerFolder->path($id);
		$member = $parentFolder['Member'];
		$this->pageTitle = $parentFolder['LockerFolder']['name'];
		$this->set(compact('member', 'parentFolder', 'path'));
		if ($this->RequestHandler->isAjax()) {
			$this->render('ajax/view');
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->LockerFolder->create();
			$this->data['LockerFolder']['member_id'] = $this->Auth->user('id');
			if ($this->LockerFolder->save($this->data)) {
				$this->Session->setFlash(__('The LockerFolder has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action' => 'view', $this->data['LockerFolder']['parent_id']));
			} else {
				$this->Session->setFlash($this->LockerFolder->validationErrors['name']);
				$this->redirect(array('action' => 'view', $this->data['LockerFolder']['parent_id']));
			}
		}
		$this->redirect(array('action' => 'view', $this->data['LockerFolder']['parent_id']));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid LockerFolder', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->LockerFolder->save($this->data,array('name'))) {
				$this->Session->setFlash(__('The LockerFolder has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The LockerFolder could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LockerFolder->read(null, $id);
		}
		$parents = $this->LockerFolder->ParentFolder->find('list');
		$this->set(compact('parents'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for LockerFolder', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LockerFolder->del($id)) {
			$this->Session->setFlash(__('LockerFolder deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	/**
	 * Handles Document and Folder Movements
	 *
	 **/
	function move() {
		$success = false;
		if (!empty($this->data)) {
			$model = $this->data['LockerFolder']['model'];
			if ($model == 'LockerFolder') {
				$item = __('Folder', true);
				$success = $this->LockerFolder->move($this->data['LockerFolder']['moved'], $this->data['LockerFolder']['id']);
			} else {
				$item = __('Document', true);
				$success = $this->LockerFolder->Document->move($this->data['LockerFolder']['moved'], $this->data['LockerFolder']['id']);
			}
			if ($success) {
				$this->Session->setFlash(sprintf(__('The %s was moved successfully', true), $item), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be moved', true), $item), 'default', array('class' => 'error'));
			}
			$this->set(compact('success'));
		} else {
			$this->Session->setFlash(__('Invalid Access', true), 'default', array('class' => 'error'));
			$this->_redirectIf(true);
		}
	}
}
?>