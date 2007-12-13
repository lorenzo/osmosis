<?php
class OrderingQuestionsController extends AppController {

	var $name = 'OrderingQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->OrderingQuestion->recursive = 0;
		$this->set('orderingQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Ordering Question.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('orderingQuestion', $this->OrderingQuestion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->OrderingQuestion->create();
			if ($this->OrderingQuestion->save($this->data)) {
				$this->Session->setFlash('The Ordering Question has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Ordering Question could not be saved. Please, try again.');
			}
		}
		$quizzes = $this->OrderingQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Ordering Question');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->OrderingQuestion->save($this->data)) {
				$this->Session->setFlash('The Ordering Question has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Ordering Question could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OrderingQuestion->read(null, $id);
		}
		$quizzes = $this->OrderingQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Ordering Question');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->OrderingQuestion->del($id)) {
			$this->Session->setFlash('Ordering Question #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>