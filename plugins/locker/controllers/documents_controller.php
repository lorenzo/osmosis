<?php
class DocumentsController extends LockerAppController {

	var $name = 'Documents';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Document->recursive = 0;
		$this->set('documents', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Document.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('document', $this->Document->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Document->create();
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash(__('The Document has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Document could not be saved. Please, try again.', true));
			}
		}
		$lockers = $this->Document->Locker->find('list');
		$this->set(compact('lockers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Document', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Document->save($this->data)) {
				$this->Session->setFlash(__('The Document has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Document could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Document->read(null, $id);
		}
		$lockers = $this->Document->Locker->find('list');
		$this->set(compact('lockers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Document', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Document->del($id)) {
			$this->Session->setFlash(__('Document deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
