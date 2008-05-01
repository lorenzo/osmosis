<?php
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
			$this->Session->setFlash(__('Invalid LockerDocument.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('lockerDocument', $this->LockerDocument->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->LockerDocument->create();
			$this->data['LockerDocument']['member_id'] = $this->Auth->user('id');
			$this->data['LockerDocument']['member_username'] = $this->Auth->user('username');
			if ($this->LockerDocument->save($this->data)) {
				$this->Session->setFlash(__('The LockerDocument has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The LockerDocument could not be saved. Please, try again.', true));
			}
		}
		$folders = $this->LockerDocument->Folder->find('list');
		$this->set(compact('members','folders'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid LockerDocument', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->LockerDocument->save($this->data)) {
				$this->Session->setFlash(__('The LockerDocument has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The LockerDocument could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LockerDocument->read(null, $id);
		}
		$members = $this->LockerDocument->Member->find('list');
		$folders = $this->LockerDocument->Folder->find('list');
		$this->set(compact('members','folders'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for LockerDocument', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LockerDocument->del($id)) {
			$this->Session->setFlash(__('LockerDocument deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function download($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Document', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->LockerDocument->recursive = false;
		$this->LockerDocument->id = $id;
		if (!$this->LockerDocument->exists()) {
			$this->Session->setFlash(__('Invalid Document', true));
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