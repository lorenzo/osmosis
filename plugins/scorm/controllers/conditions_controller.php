<?php
class ConditionsController extends ScormAppController {

	var $name = 'Conditions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Condition->recursive = 0;
		$this->set('conditions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Condition.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('condition', $this->Condition->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->Condition->create();
			if ($this->Condition->save($this->data)) {
				$this->Session->setFlash('The Condition has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Condition could not be saved. Please, try again.');
			}
		}
		$rules = $this->Condition->Rule->generateList();
		$this->set(compact('rules'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Condition');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->Condition->save($this->data)) {
				$this->Session->setFlash('The Condition saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Condition could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Condition->read(null, $id);
		}
		$rules = $this->Condition->Rule->generateList();
		$this->set(compact('rules'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Condition');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Condition->del($id)) {
			$this->Session->setFlash('Condition #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
