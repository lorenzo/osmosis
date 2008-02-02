<?php
class DiscussionsController extends AppController {

	var $name = 'Discussions';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Discussion->recursive = 0;
		$this->set('discussions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Discussion.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('discussion', $this->Discussion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Discussion->create();
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__('The Discussion has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		}
		$subjects = $this->Discussion->Subject->find('list');
		$members = $this->Discussion->Member->find('list');
		$this->set(compact('subjects', 'members'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Discussion', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__('The Discussion has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Discussion->read(null, $id);
		}
		$subjects = $this->Discussion->Subject->find('list');
		$members = $this->Discussion->Member->find('list');
		$this->set(compact('subjects','members'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Discussion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Discussion->del($id)) {
			$this->Session->setFlash(__('Discussion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>