<?php
class OrderingChoicesController extends AppController {

	var $name = 'OrderingChoices';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->OrderingChoice->recursive = 0;
		$this->set('orderingChoices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Ordering Choice.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('orderingChoice', $this->OrderingChoice->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->OrderingChoice->create();
			if ($this->OrderingChoice->save($this->data)) {
				$this->Session->setFlash('The Ordering Choice has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Ordering Choice could not be saved. Please, try again.');
			}
		}
		$orderingQuestions = $this->OrderingChoice->OrderingQuestion->generateList();
		$this->set(compact('orderingQuestions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Ordering Choice');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->OrderingChoice->save($this->data)) {
				$this->Session->setFlash('The Ordering Choice has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Ordering Choice could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OrderingChoice->read(null, $id);
		}
		$orderingQuestions = $this->OrderingChoice->OrderingQuestion->generateList();
		$this->set(compact('orderingQuestions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Ordering Choice');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->OrderingChoice->del($id)) {
			$this->Session->setFlash('Ordering Choice #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>