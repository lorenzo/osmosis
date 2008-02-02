<?php
class MatchingQuestionsController extends AppController {

	var $name = 'MatchingQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->MatchingQuestion->recursive = 0;
		$this->set('matchingQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Matching Question.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('matchingQuestion', $this->MatchingQuestion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->MatchingQuestion->create();
			if ($this->MatchingQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Matching Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Matching Question could not be saved. Please, try again.',true));
			}
		}
		$quizzes = $this->MatchingQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Matching Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->MatchingQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Matching Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Matching Question could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MatchingQuestion->read(null, $id);
		}
		$quizzes = $this->MatchingQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Matching Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->MatchingQuestion->del($id)) {
			$this->Session->setFlash(__('Matching Question #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>