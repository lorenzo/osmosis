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
class DocumentsController extends LockerAppController {

	var $name = 'Documents';
	var $helpers = array('Html', 'Form');
	var $uses = array('Locker.LockerDocument');
	
	function _ownerAuthorization() {	
		switch ($this->action) {
			case 'view' :
			case 'download' :
			case 'drop' :
				return true;
			case 'add' :
				if (isset($this->data['LockerDocument']['folder_id']))
					return $this->LockerDocument->Folder->isOwner($this->Auth->user('id'),$this->data['LockerDocument']['folder_id']);
				break;
			case 'edit' :
			case 'move' :
			case 'delete' :
				$check = false;
				if (isset($this->data['LockerDocument']['id']))
					$check = $this->data['LockerDocument']['id'];
					
				elseif (isset($this->params['pass'][0]))
					$check = $this->params['pass'][0];
				
				return $this->LockerDocument->isOwner($this->Auth->user('id'),$check);
		}
			
		return false;
	}


	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid document', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->LockerDocument->contain('Member');
		$lockerDocument = $this->LockerDocument->read(null, $id);
		$member = $lockerDocument['Member'];
		$path = $this->LockerDocument->Folder->path($lockerDocument['LockerDocument']['folder_id']);
		$this->set(compact('lockerDocument','path', 'member'));
		if ($this->RequestHandler->isAjax()) {
			$this->render('ajax/view');
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->LockerDocument->create();
			if ($this->__saveFile()) {
				$this->Session->setFlash(__('The document has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('controller' => 'folders', 'action'=>'view', $this->data['LockerDocument']['folder_id']));
			} else {
				$this->Session->setFlash(__('The LockerDocument could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$folders = $this->LockerDocument->Folder->find('list');
		$this->set(compact('members','folders'));
	}

	/**
	 * Helper function that saves a file to the locker
	 *
	 * @return boolean True on success
	 **/
	function __saveFile($member_id = null, $folder_id = null, $username = null) {
		if ($member_id) {
			$this->data['LockerDocument']['member_id'] = $member_id;
		} else {
			$this->data['LockerDocument']['member_id'] = $this->Auth->user('id');
		}
		if ($folder_id) {
			$this->data['LockerDocument']['folder_id'] = $folder_id;
		}
		if ($username) {
			$this->data['LockerDocument']['member_username'] = $username;
		} else {
			$this->data['LockerDocument']['member_username'] = $this->Auth->user('username');
		}
		return $this->LockerDocument->save($this->data);
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid LockerDocument', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->LockerDocument->save($this->data)) {
				$this->Session->setFlash(__('The document has been saved', true), 'default', array('class' => 'success'));
				$folder_id = $this->LockerDocument->field('folder_id');
				$this->redirect(array('controller' => 'folders', 'action'=>'view', $folder_id));
			} else {
				$this->Session->setFlash(__('The document could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LockerDocument->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for document', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LockerDocument->del($id)) {
			$this->Session->setFlash(__('Document deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function download($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Document', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->LockerDocument->recursive = false;
		$this->LockerDocument->id = $id;
		if (!$this->LockerDocument->exists()) {
			$this->Session->setFlash(__('Invalid Document', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->view = 'Locker.Document';
		$info = $this->LockerDocument->read(null,$id);
		$file = new File($this->LockerDocument->getFilePath($id,$this->Auth->user('username')));
		$path = $file->pwd();
		$extension = $file->ext();
		$download = true;
		$name = $info['LockerDocument']['name'];
		if (!empty($info['LockerDocument']['type']));
			$mime = $info['LockerDocument']['type'];

		$this->set(compact('path','extension','download','mime','name'));
	}
	
	/**
	 * Manages drop of files from other users
	 *
	 * @return void
	 **/
	function drop() {
		if (!empty($this->data)) {
			$this->LockerDocument->Folder->contain('Member');
			$current_folder = $this->LockerDocument->Folder->find(
				'first',
				array(
					'conditions' => array('Folder.id' => $this->data['LockerDocument']['folder_id']),
					'fields'	 => array('id')
				)
			);
			$folder_id = $current_folder['Folder']['id'];
			$username = $current_folder['Member']['username'];
			$user_id = $current_folder['Member']['id'];
			$this->LockerDocument->Folder->recursive = -1;
			$conditions = array(
				'Folder.parent_id'	=> null,
				'Folder.member_id'	=> $user_id
			);
			$locker_id = $this->LockerDocument->Folder->field('id', $conditions);
			
			$conditions['Folder.parent_id'] = $locker_id;
			$conditions['Folder.name'] = 'dropbox';
			$dropbox = $this->LockerDocument->Folder->field('id', $conditions);

			if ($this->__saveFile(null, $dropbox, $username)) {
				$this->Session->setFlash(__('The file was dropped correctly', true));
				$this->redirect(array('controller' => 'folders', 'action'=>'view', $folder_id));
			} else {
				$this->Session->setFlash(__('The file could not be saved. Please, try again.', true));
			}
		}
		$folders = $this->LockerDocument->Folder->find('list');
		$this->set(compact('members','folders'));
	}

}
?>