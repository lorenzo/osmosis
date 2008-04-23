<?php
class ChoiceQuestionsController extends AppController {

	var $name = 'ChoiceQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->ChoiceQuestion->recursive = 0;
		$this->set('choiceQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Choice Question.',true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('choiceQuestion', $this->ChoiceQuestion->read(null, $id));
	}

	function add() {
		$totalChoices = 2;
		if(isset($this->data['UI']['addChoice']) && $this->data['UI']['addChoice'] ) {
			$totalChoices = count($this->data['ChoiceChoice']) + 1;
			$this->set('totalChoices',$totalChoices);
			unset($this->data['UI']['addChoice']);
			return;
		}
		
		if (!empty($this->data)) {
			$this->ChoiceQuestion->create();
			if ($this->ChoiceQuestion->saveAll($this->data)) {
				$habtm_data = array('choice_question_id' => $this->ChoiceQuestion->getLastInsertID(), 'quiz_id' => $this->data['Quiz'][0]['id']);
				if ($this->ChoiceQuestion->QuizChoice->save($habtm_data)) {
					$this->Session->setFlash(__('The Choice Question has been saved',true));
					$this->redirect(array('controller' => 'quizzes', 'action'=>'edit', $this->data['Quiz'][0]['id']));
				}
			} else {
				$totalChoices = count($this->data['ChoiceChoice']);
				$this->Session->setFlash(__('The Choice Question could not be saved. Please, try again.',true));
			}
		}
		$this->set('totalChoices',$totalChoices);
		if(isset($this->params['named']['quiz'])) {
			$this->data['Quiz']['id'] = $this->params['named']['quiz'];
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Choice Question',true));
			$this->redirect(array('action'=>'index'));
		}
		
		if(isset($this->data['UI']['addChoice'])) {
			$totalChoices = count($this->data['ChoiceChoice']) + 1;
			$this->set('totalChoices',$totalChoices);
			unset($this->data['UI']['addChoice']);
			return;
		}
		
		if (!empty($this->data)) {
			if ($this->ChoiceQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Choice Question has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$totalChoices = count($this->data['ChoiceChoice']);
				$this->Session->setFlash(__('The Choice Question could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ChoiceQuestion->read(null, $id);
			$totalChoices = count($this->data['Choice']);
		}
		
		$this->set('totalChoices',$totalChoices);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Choice Question',true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ChoiceQuestion->del($id)) {
			$this->Session->setFlash(__('Choice Question #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>