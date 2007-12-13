<?php
class ChoiceChoicesController extends AppController {

	var $name = 'ChoiceChoices';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->ChoiceChoice->recursive = 0;
		$this->set('choiceChoices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Choice Choice.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('choiceChoice', $this->ChoiceChoice->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ChoiceChoice->create();
			if ($this->ChoiceChoice->save($this->data)) {
				$this->Session->setFlash('The Choice Choice has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Choice Choice could not be saved. Please, try again.');
			}
		}
		$choiceQuestions = $this->ChoiceChoice->ChoiceQuestion->generateList();
		$this->set(compact('choiceQuestions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Choice Choice');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ChoiceChoice->save($this->data)) {
				$this->Session->setFlash('The Choice Choice has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Choice Choice could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChoiceChoice->read(null, $id);
		}
		$choiceQuestions = $this->ChoiceChoice->ChoiceQuestion->generateList();
		$this->set(compact('choiceQuestions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Choice Choice');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ChoiceChoice->del($id)) {
			$this->Session->setFlash('Choice Choice #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>