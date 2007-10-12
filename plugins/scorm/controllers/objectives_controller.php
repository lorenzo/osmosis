<?php
class ObjectivesController extends ScormAppController {

	var $name = 'Objectives';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Objective->recursive = 0;
		$this->set('objectives', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Objective.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('objective', $this->Objective->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Objective->create();
			if ($this->Objective->save($this->data)) {
				$this->Session->setFlash('The Objective has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Objective could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Objective');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Objective->save($this->data)) {
				$this->Session->setFlash('The Objective saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Objective could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Objective->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Objective');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Objective->del($id)) {
			$this->Session->setFlash('Objective #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
