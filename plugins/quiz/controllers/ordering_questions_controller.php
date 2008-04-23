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
			$this->Session->setFlash(__('Invalid Ordering Question.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('orderingQuestion', $this->OrderingQuestion->read(null, $id));
	}

	function add() {
		$totalChoices = 2;
		if(isset($this->data['UI']['addChoice']) && $this->data['UI']['addChoice'] ) {
			$totalChoices = count($this->data['OrderingChoice']) + 1;
			$this->set('totalChoices',$totalChoices);
			unset($this->data['UI']['addChoice']);
			return;
		}
		
		
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->OrderingQuestion->create();
			if ($this->OrderingQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Ordering Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$totalChoices = count($this->data['OrderingChoice']);
				$this->Session->setFlash(__('The Ordering Question could not be saved. Please, try again.',true));
			}
		}
		$this->set('totalChoices', $totalChoices);
		if(isset($this->params['named']['quiz'])) {
			$this->data['Quiz']['id'] = $this->params['named']['quiz'];
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ordering Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->OrderingQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Ordering Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Ordering Question could not be saved. Please, try again.',true));
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
			$this->Session->setFlash(__('Invalid id for Ordering Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->OrderingQuestion->del($id)) {
			$this->Session->setFlash(__('Ordering Question #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>