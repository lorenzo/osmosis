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
			'cloze_question'	=> __('Cloze Question', true),
			'matching_question'	=> __('Matching Question', true),
			'oredering_question'=> __('Ordering Question', true),
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
		/*
		$associationQuestions = $this->Quiz->AssociationQuestion->find('list');
		$choiceQuestions = $this->Quiz->ChoiceQuestion->find('list');
		$clozeQuestions = $this->Quiz->ClozeQuestion->find('list');
		$matchingQuestions = $this->Quiz->MatchingQuestion->find('list');
		$orderingQuestions = $this->Quiz->OrderingQuestion->find('list');
		$textQuestions = $this->Quiz->TextQuestion->find('list');
		$this->set(compact('associationQuestions','choiceQuestions','clozeQuestions','matchingQuestions','orderingQuestions','textQuestions'));*/
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

	function add_question($question_type=null, $quiz_id = null) {
		if (empty($this->data) && !$question_type) {
			$this->Session->setFlash(__('Invalid Question Type', true));
			$this->redirect(array('action' => 'index'));
		}
		$questionType = Inflector::Camelize($question_type);
		if (empty($this->data) && !$quiz_id) {
			$this->Session->setFlash(__('Invalid Quiz', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Quiz->id = $this->data['Quiz']['id'];
			
			var_dump($this->Quiz->save($this->data));
			debug($this->Quiz->validationErrors);
			debug($this->data);
			
		} else {
			$this->data['Quiz']['id'] = $quiz_id;
		}
		
 		$quiz_questions = $this->Quiz->find('first', array('conditions' => array('id' => $quiz_id)));
	 	$quiz_questions = Set::extract($quiz_questions[$questionType], '{n}.id');
 		$available_questions = $this->paginate('Quiz.' . $questionType);

		$this->set('question_type', $question_type);
 		$this->set('available_questions', $available_questions);
 		$this->set('questionType', $questionType);
 		$this->set('id', $quiz_id);
 		$this->set('quiz_questions', $quiz_questions);
	}

}
?>