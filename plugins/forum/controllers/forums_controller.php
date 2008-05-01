<?php
class ForumsController extends ForumAppController {

	var $name = 'Forums';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Forum->recursive = 0;
		$this->set('forums', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Forum.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Forum->recursive = 2;
		$this->set('forum', $this->Forum->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Forum->create();
			if ($this->Forum->save($this->data)) {
				$this->Session->setFlash(__('The Forum has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Forum could not be saved. Please, try again.', true));
			}
		}
		$courses = $this->Forum->Course->find('list');
		$this->set(compact('courses'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Forum', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Forum->save($this->data)) {
				$this->Session->setFlash(__('The Forum has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Forum could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Forum->read(null, $id);
		}
		$courses = $this->Forum->Course->find('list');
		$this->set(compact('courses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Forum', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Forum->del($id)) {
			$this->Session->setFlash(__('Forum deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
}
?>