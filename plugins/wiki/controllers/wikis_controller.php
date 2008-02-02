<?php
class WikisController extends WikiAppController {

	var $name = 'Wikis';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Wiki->recursive = 0;
		$this->set('wikis', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Wiki.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('wiki', $this->Wiki->read(null, $id));
	}

	function add() { 
		if (!empty($this->data)) {
			$this->Wiki->create();
			if ($this->Wiki->save($this->data)) {
				$this->Session->setFlash(__('The Wiki has been saved', true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Wiki could not be saved. Please, try again.');
			}
		}
		$courses = @$this->Wiki->Course->generateList();
		$this->set(compact('courses'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Wiki');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Wiki->save($this->data)) {
				$this->Session->setFlash('The Wiki has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Wiki could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Wiki->read(null, $id);
		}
		$courses = @$this->Wiki->Course->generateList();
		$this->set(compact('courses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Wiki');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Wiki->del($id)) {
			$this->Session->setFlash('Wiki #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>