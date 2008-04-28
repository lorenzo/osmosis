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
		if ($this->_updateChoiceCount()) {
			return;
		}
		if (!empty($this->data)) {
			$this->_cleanupEmpty();			
			$this->OrderingQuestion->create();
			$this->OrderingQuestion->set($this->data);
			if ($this->OrderingQuestion->validates() && $this->OrderingQuestion->saveAll($this->data, array('validate' => false))) {
				$habtm_data = array(
					'ordering_question_id' => $this->OrderingQuestion->getLastInsertID(),
					'quiz_id' => $this->data['Quiz'][0]['id']
				);
				if ($this->OrderingQuestion->QuizOrdering->save($habtm_data)) {
					$this->Session->setFlash(__('The Ordering Question has been saved',true));
					$this->redirect(
						array('controller' => 'quizzes', 'action'=>'edit', 	$this->data['Quiz'][0]['id'])
					);
				}
			} else {
				$totalChoices = count($this->data['OrderingChoice']);
				$this->Session->setFlash(__('The Ordering Question could not be saved. Please, try again.',true));
			}
		}

		if(isset($this->params['named']['quiz'])) {
			$this->data['Quiz']['id'] = $this->params['named']['quiz'];
		}
	}
	
	private function _updateChoiceCount() {
			$totalChoices = 2;
			$added = false;
			if(isset($this->data['UI']['addChoice']) && $this->data['UI']['addChoice'] ) {
				$totalChoices = count($this->data['OrderingChoice']) + 1;
				unset($this->data['UI']['addChoice']);
				$added = true;
			}
			$this->set('totalChoices',$totalChoices);
			return $added;
	}
	
	private function _cleanupEmpty() {
		for ($i=0;$i<count($this->data['OrderingChoice']);$i++) {
			$choice = $this->data['OrderingChoice'][$i];
			if ($i>1 && empty($choice['text']) && empty($choice['position'])) {
				unset($this->data['OrderingChoice'][$i]);
				$this->data['OrderingChoice'] = array_values($this->data['OrderingChoice']);
				$i--;
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Ordering Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
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