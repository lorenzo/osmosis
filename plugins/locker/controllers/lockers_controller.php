<?php
class LockersController extends LockerAppController {

	var $name = 'Lockers';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Locker->recursive = 0;
		$this->set('lockers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Locker.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('locker', $this->Locker->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Locker->create();
			if ($this->Locker->save($this->data)) {
				$this->Session->setFlash(__('The Locker has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Locker could not be saved. Please, try again.', true));
			}
		}
		$members = $this->Locker->Member->find('list');
		$this->set(compact('members'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Locker', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Locker->save($this->data)) {
				$this->Session->setFlash(__('The Locker has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Locker could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Locker->read(null, $id);
		}
		$members = $this->Locker->Member->find('list');
		$this->set(compact('members'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Locker', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Locker->del($id)) {
			$this->Session->setFlash(__('Locker deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
