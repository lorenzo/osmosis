<?php
class FoldersController extends LockerAppController {

	var $name = 'Folders';
	var $helpers = array('Html', 'Form');
	var $uses = array('Locker.LockerFolder');

	function index() {
		$this->LockerFolder->recursive = 0;
		$this->set('lockerFolders', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid LockerFolder.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('lockerFolder', $this->LockerFolder->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->LockerFolder->create();
			$this->data['LockerFolder']['member_id'] = $this->Auth->user('id');
			if ($this->LockerFolder->save($this->data)) {
				$this->Session->setFlash(__('The LockerFolder has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The LockerFolder could not be saved. Please, try again.', true));
			}
		}
		$parents = $this->LockerFolder->ParentFolder->find('list');
		$this->set(compact('parents'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid LockerFolder', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->LockerFolder->save($this->data)) {
				$this->Session->setFlash(__('The LockerFolder has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The LockerFolder could not be saved. Please, try again.', true));
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
			$this->Session->setFlash(__('Invalid id for LockerFolder', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LockerFolder->del($id)) {
			$this->Session->setFlash(__('LockerFolder deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>