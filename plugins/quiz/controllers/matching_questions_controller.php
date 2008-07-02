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
class MatchingQuestionsController extends AppController {

	var $name = 'MatchingQuestions';
	var $helpers = array('Html', 'Form' );

	function _setActiveCourse() {
		parent::_setActiveCourse();
		if (empty($this->activeCourse) && isset($this->data['Quiz'][0]['id'])) {
			$this->activeCourse = $this->MatchingQuestion->Quiz->field('course_id',array('Quiz.id' => $this->data['Quiz'][0]['id']));
		}
		$actions = array('add');
		if (empty($this->activeCourse) && in_array($this->action,$actions) &&isset($this->params['named']['quiz'])) {
			$this->activeCourse = $this->MatchingQuestion->Quiz->field('course_id',array('Quiz.id' => $this->params['named']['quiz']));
		}
	}
	
	function index() {
		$this->MatchingQuestion->recursive = 0;
		$this->set('matchingQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Matching Question',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->MatchingQuestion->recursive = 2;
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
				$habtm_data = array(
					'matching_question_id' => $this->MatchingQuestion->getLastInsertID(),
					'quiz_id' => $this->data['Quiz'][0]['id']
				);
				
				if ($this->MatchingQuestion->QuizMatching->save($habtm_data)) {
					$this->Session->setFlash(__('The Choice Question has been saved',true), 'default', array('class' => 'success'));
					$this->redirect(array('controller' => 'quizzes', 'action'=>'edit', $this->data['Quiz'][0]['id']));
				}
			} else {
				$this->Session->setFlash(__('The Matching Question could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
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
		return $added;
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
			$this->Session->setFlash(__('Invalid Matching Question',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->MatchingQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Matching Question has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Matching Question could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
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
			$this->Session->setFlash(__('Invalid id for Matching Question',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->MatchingQuestion->del($id)) {
			$this->Session->setFlash(__('Matching Question deleted',true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>