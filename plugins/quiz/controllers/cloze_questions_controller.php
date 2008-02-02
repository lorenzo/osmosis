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
			$this->Session->setFlash(__('Invalid Cloze Question.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('clozeQuestion', $this->ClozeQuestion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ClozeQuestion->create();
			if ($this->ClozeQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Cloze Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Cloze Question could not be saved. Please, try again.',true));
			}
		}
		$quizzes = $this->ClozeQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Cloze Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ClozeQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Cloze Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Cloze Question could not be saved. Please, try again.',true));
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
			$this->Session->setFlash(__('Invalid id for Cloze Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ClozeQuestion->del($id)) {
			$this->Session->setFlash(__('Cloze Question #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>