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

	function index() {
		$this->LockerDocument->recursive = 0;
		$this->set('lockerDocuments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid LockerDocument', true), 'default', array('class' => 'error'));
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
			$this->data['LockerDocument']['member_id'] = $this->Auth->user('id');
			$this->data['LockerDocument']['member_username'] = $this->Auth->user('username');
			if ($this->LockerDocument->save($this->data)) {
				$this->Session->setFlash(__('The LockerDocument has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('controller' => 'folders', 'action'=>'view', $this->data['LockerDocument']['folder_id']));
			} else {
				$this->Session->setFlash(__('The LockerDocument could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$folders = $this->LockerDocument->Folder->find('list');
		$this->set(compact('members','folders'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid LockerDocument', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->LockerDocument->save($this->data)) {
				$this->Session->setFlash(__('The LockerDocument has been saved', true), 'default', array('class' => 'success'));
				$folder_id = $this->LockerDocument->field('folder_id');
				$this->redirect(array('controller' => 'folders', 'action'=>'view', $folder_id));
			} else {
				$this->Session->setFlash(__('The LockerDocument could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LockerDocument->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for LockerDocument', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LockerDocument->del($id)) {
			$this->Session->setFlash(__('LockerDocument deleted', true), 'default', array('class' => 'success'));
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

}
?>