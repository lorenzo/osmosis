<?php
/* SVN FILE: $Id$ */
/**
 * Ósmosis LMS: <http://www.osmosislms.org/>
 * Copyright 2008, Ósmosis LMS
 *
 * This file is part of Ósmosis LMS.
 * Ósmosis LMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Ósmosis LMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Ósmosis LMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource
 * @copyright		Copyright 2008, Ósmosis LMS
 * @link			http://www.osmosislms.org/
 * @package			org.osmosislms
 * @subpackage		org.osmosislms.app
 * @since			Version 2.0 
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 */
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
