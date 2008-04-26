<?php
class QuizzesController extends QuizAppController {

	var $name = 'Quizzes';
	var $helpers = array('Html', 'Form' );

	/**
	 * question_types: used on the list of available question types
	 */	
	var $question_types = null;
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->question_types = array(
			'choice_question'	=> __('Choice Question', true),
			// 'cloze_question'	=> __('Cloze Question', true),
			'matching_question'	=> __('Matching Question', true),
			'ordering_question'=> __('Ordering Question', true),
			'text_question'		=> __('Text Question', true)
		);
		$this->set('question_types', $this->question_types);
	}
	
	function index() {
		$this->Quiz->recursive = 0;
		$this->set('quizzes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Quiz.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('quiz', $this->Quiz->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Quiz->create();
			if ($this->Quiz->save($this->data)) {
				$this->Session->setFlash(__('The Quiz has been saved',true));
				$this->redirect(array('action'=>'edit', $this->Quiz->getLastInsertId()), null, true);
			} else {
				$this->Session->setFlash(__('The Quiz could not be saved. Please, try again.',true));
			}
		}
/*		$associationQuestions = $this->Quiz->AssociationQuestion->find('list');
		$choiceQuestions = $this->Quiz->ChoiceQuestion->find('list');
		$clozeQuestions = $this->Quiz->ClozeQuestion->find('list');
		$matchingQuestions = $this->Quiz->MatchingQuestion->find('list');
		$orderingQuestions = $this->Quiz->OrderingQuestion->find('list');
		$textQuestions = $this->Quiz->TextQuestion->find('list');
		$this->set(compact('associationQuestions', 'choiceQuestions', 'clozeQuestions', 'matchingQuestions', 'orderingQuestions', 'textQuestions'));
		*/
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Quiz',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		
		if (!empty($this->data)) {
			// debug($this->data);die;
			// 			if ($this->Quiz->save($this->data)) {
			// 				$this->Session->setFlash(__('The Quiz has been saved',true));
			// 				$this->redirect(array('action'=>'index'), null, true);
			// 			} else {
			// 				$this->Session->setFlash(__('The Quiz could not be saved. Please, try again.',true));
			// 			}
		} else {
			$this->Quiz->recursive = 2;
			$this->data = $this->Quiz->read(null, $id);
		}
		
		$question_type = 'all';
		if (isset($this->params['named']['question_type'])) {
			$question_type = $this->params['named']['question_type'];
		}
		$this->set('question_type', $question_type);
		$question_name = 'All';
		if (isset($this->question_types[$question_type])) {
			$question_name = $this->question_types[$question_type];
		}
		$this->set('question_name', $question_name);
		if ($question_type != 'all') {
			$questions = $this->Quiz->getQuestions($question_type, $this->data['Quiz']['id']);
		} else {
			$questions = $this->Quiz->getQuestions($this->question_types, $this->data['Quiz']['id']);
		}
		
		$this->set('question_list', $questions);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Quiz',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Quiz->del($id)) {
			$this->Session->setFlash(__('Quiz #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	function rename($id=null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Quiz',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Quiz->save($this->data)) {
				$this->Session->setFlash(__('The Quiz has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Quiz could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Quiz->read(null, $id);
		}
	}

	function add_question($quiz_id = null) {
		if (empty($this->data) || !$quiz_id) {
			$this->Session->setFlash(__('Invalid Quiz', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Quiz->id = $quiz_id;
			if ($this->Quiz->addQuestions($this->data)) {
				$this->Session->setFlash(__('The questions where added to the quiz.', true));
				$this->redirect(
					array('controller' => 'quizzes', 'action' => 'edit', $quiz_id)
				);
			} else {
				$this->Session->setFlash(__('The questions could not be added to the quiz.', true));
				$this->redirect(
					array('controller' => 'quizzes', 'action' => 'edit', $quiz_id)
				);
			}
		}
	}

}
?>