<?php
class ChoiceConsiderationsController extends ScormAppController {

	var $name = 'ChoiceConsiderations';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->ChoiceConsideration->recursive = 0;
		$this->set('choiceConsiderations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Choice Consideration.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('choiceConsideration', $this->ChoiceConsideration->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ChoiceConsideration->create();
			if ($this->ChoiceConsideration->save($this->data)) {
				$this->Session->setFlash('The Choice Consideration has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Choice Consideration could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Choice Consideration');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ChoiceConsideration->save($this->data)) {
				$this->Session->setFlash('The Choice Consideration saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Choice Consideration could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChoiceConsideration->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Choice Consideration');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ChoiceConsideration->del($id)) {
			$this->Session->setFlash('Choice Consideration #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
