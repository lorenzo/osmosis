<?php
class MatchingChoicesController extends AppController {

	var $name = 'MatchingChoices';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->MatchingChoice->recursive = 0;
		$this->set('matchingChoices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Matching Choice.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('matchingChoice', $this->MatchingChoice->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->MatchingChoice->create();
			if ($this->MatchingChoice->save($this->data)) {
				$this->Session->setFlash('The Matching Choice has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Matching Choice could not be saved. Please, try again.');
			}
		}
		$matchingQuestions = $this->MatchingChoice->MatchingQuestion->generateList();
		$this->set(compact('matchingQuestions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Matching Choice');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->MatchingChoice->save($this->data)) {
				$this->Session->setFlash('The Matching Choice has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Matching Choice could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MatchingChoice->read(null, $id);
		}
		$matchingQuestions = $this->MatchingChoice->MatchingQuestion->generateList();
		$this->set(compact('matchingQuestions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Matching Choice');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->MatchingChoice->del($id)) {
			$this->Session->setFlash('Matching Choice #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>