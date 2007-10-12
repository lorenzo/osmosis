<?php
class RandomizationsController extends ScormAppController {

	var $name = 'Randomizations';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Randomization->recursive = 0;
		$this->set('randomizations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Randomization.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('randomization', $this->Randomization->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Randomization->create();
			if ($this->Randomization->save($this->data)) {
				$this->Session->setFlash('The Randomization has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Randomization could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Randomization');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Randomization->save($this->data)) {
				$this->Session->setFlash('The Randomization saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Randomization could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Randomization->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Randomization');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Randomization->del($id)) {
			$this->Session->setFlash('Randomization #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
