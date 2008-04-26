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
		if ($this->_updateChoiceCount()) {
			return;
		}
		
		if (!empty($this->data)) {
			$this->MatchingQuestion->create();
			$this->MatchingQuestion->set($this->data);
			if ($this->MatchingQuestion->validates()) {
				$newData = array();
				$newData['MatchingQuestion'] = $this->data['MatchingQuestion'];
				foreach ($this->data['SourceChoice'] as  $i => $d) {
					$newData['SourceChoice'][$i] = $d;
					$newData['SourceChoice'][$i]['TargetChoice'] = $this->data['TargetChoice'][$d['correct'] - 1];
				}
				
			} else return;
			
			if ($this->MatchingQuestion->saveAll($newData,array('validate' => false))) {
				$this->Session->setFlash(__('The Matching Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Matching Question could not be saved. Please, try again.',true));
			}
		}
		if(isset($this->params['named']['quiz'])) {
			$this->data['Quiz']['id'] = $this->params['named']['quiz'];
		}
	}
	
	private function _updateChoiceCount() {
		$totalQuestions = 2;
		$added = false;
		if (isset($this->data['SourceChoice'])) {
			$totalQuestions = count($this->data['SourceChoice']);
		}
		$totalAnswers = 2;
		if (isset($this->data['TargetChoice'])) {
			$totalAnswers = count($this->data['TargetChoice']);
		}
		
		if (isset($this->data['UI']['addQuestion']) && $this->data['UI']['addQuestion']) {
			$totalQuestions += 1;
			unset($this->data['UI']['addQuestion']);
			$added = true;
		}
		if (isset($this->data['UI']['addAnswer']) && $this->data['UI']['addAnswer']) {
			$totalAnswers += 1;
			unset($this->data['UI']['addAnswer']);
			$added = true;
		}
		
		$this->set('totalQuestions',$totalQuestions);
		$this->set('totalAnswers',$totalAnswers);
		return false;
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