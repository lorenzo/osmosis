<?php
class ScoPresentationsController extends ScormAppController {

	var $name = 'ScoPresentations';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->ScoPresentation->recursive = 0;
		$this->set('scoPresentations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Sco Presentation.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('scoPresentation', $this->ScoPresentation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ScoPresentation->create();
			if ($this->ScoPresentation->save($this->data)) {
				$this->Session->setFlash('The Sco Presentation has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Sco Presentation could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Sco Presentation');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ScoPresentation->save($this->data)) {
				$this->Session->setFlash('The Sco Presentation saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Sco Presentation could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ScoPresentation->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Sco Presentation');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ScoPresentation->del($id)) {
			$this->Session->setFlash('Sco Presentation #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
