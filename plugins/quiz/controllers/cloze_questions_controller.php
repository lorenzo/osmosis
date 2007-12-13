<?php
class ClozeQuestionsController extends AppController {

	var $name = 'ClozeQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->ClozeQuestion->recursive = 0;
		$this->set('clozeQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Cloze Question.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('clozeQuestion', $this->ClozeQuestion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ClozeQuestion->create();
			if ($this->ClozeQuestion->save($this->data)) {
				$this->Session->setFlash('The Cloze Question has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Cloze Question could not be saved. Please, try again.');
			}
		}
		$quizzes = $this->ClozeQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Cloze Question');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ClozeQuestion->save($this->data)) {
				$this->Session->setFlash('The Cloze Question has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Cloze Question could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ClozeQuestion->read(null, $id);
		}
		$quizzes = $this->ClozeQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Cloze Question');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ClozeQuestion->del($id)) {
			$this->Session->setFlash('Cloze Question #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>