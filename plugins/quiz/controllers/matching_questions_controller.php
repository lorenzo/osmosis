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
			$this->_cleanupEmpty();
			$this->MatchingQuestion->create();
			$this->MatchingQuestion->set($this->data);
			if ($this->MatchingQuestion->validates()) {
				$newData = array();
				$newData['MatchingQuestion'] = $this->data['MatchingQuestion'];
				foreach ($this->data['TargetChoice'] as  $i => $d) {
					$newData['TargetChoice'][$i] = $d;
					$correct = $i +1;
					$newData['TargetChoice'][$i]['SourceChoice'] = Set::extract("/SourceChoice[correct=$correct]",$this->data);
				}
			} else return;
			
			if ($this->MatchingQuestion->saveAll($newData,array('validate' => false))) {
				$this->Session->setFlash(__('The Matching Question has been saved',true));
				$this->redirect(
					array('controller' => 'quizzes', 'action'=>'edit', 	$this->data['Quiz'][0]['id'])
				);
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
	
	private function _cleanupEmpty() {
		for ($i=0;$i<count($this->data['SourceChoice']);$i++) {
			$choice = $this->data['SourceChoice'][$i];
			if ($i>1 && empty($choice['text']) && empty($choice['correct'])) {
				unset($this->data['SourceChoice'][$i]);
				$this->data['SourceChoice'] = array_values($this->data['SourceChoice']);
				$i--;
			}
		}
		for ($i=0;$i<count($this->data['TargetChoice']);$i++) {
			$choice = $this->data['TargetChoice'][$i];
			if ($i>1 && empty($choice['text'])) {
				unset($this->data['TargetChoice'][$i]);
				$this->data['TargetChoice'] = array_values($this->data['TargetChoice']);
				$i--;
			}
		}
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