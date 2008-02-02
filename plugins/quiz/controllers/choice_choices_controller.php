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
			$this->Session->setFlash(__('Invalid Choice Choice.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('choiceChoice', $this->ChoiceChoice->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ChoiceChoice->create();
			if ($this->ChoiceChoice->save($this->data)) {
				$this->Session->setFlash(__('The Choice Choice has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Choice Choice could not be saved. Please, try again.',true));
			}
		}
		$choiceQuestions = $this->ChoiceChoice->ChoiceQuestion->generateList();
		$this->set(compact('choiceQuestions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Choice Choice',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ChoiceChoice->save($this->data)) {
				$this->Session->setFlash(__('The Choice Choice has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Choice Choice could not be saved. Please, try again.',true));
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
			$this->Session->setFlash(__('Invalid id for Choice Choice',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ChoiceChoice->del($id)) {
			$this->Session->setFlash(__('Choice Choice #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>