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
class OrderingQuestionsController extends AppController {

	var $name = 'OrderingQuestions';
	var $helpers = array('Html', 'Form' );
	
	function _setActiveCourse() {
		parent::_setActiveCourse();
		if (empty($this->activeCourse) && isset($this->data['Quiz'][0]['id'])) {
			$this->activeCourse = $this->OrderingQuestion->Quiz->field('course_id',array('Quiz.id' => $this->data['Quiz'][0]['id']));
		}
		$actions = array('add');
		if (empty($this->activeCourse) && in_array($this->action,$actions) &&isset($this->params['named']['quiz'])) {
			$this->activeCourse = $this->OrderingQuestion->Quiz->field('course_id',array('Quiz.id' => $this->params['named']['quiz']));
		}
	}

	function index() {
		$this->OrderingQuestion->recursive = 0;
		$this->set('orderingQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Ordering Question',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->OrderingQuestion->recursive = 2;
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
					$this->Session->setFlash(__('The Ordering Question has been saved',true), 'default', array('class' => 'success'));
					$this->redirect(
						array('controller' => 'quizzes', 'action'=>'edit', 	$this->data['Quiz'][0]['id'])
					);
				}
			} else {
				$totalChoices = count($this->data['OrderingChoice']);
				$this->Session->setFlash(__('The Ordering Question could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
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
			$this->Session->setFlash(__('Invalid Ordering Question',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->OrderingQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Ordering Question has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Ordering Question could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
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
			$this->Session->setFlash(__('Invalid id for Ordering Question',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->OrderingQuestion->del($id)) {
			$this->Session->setFlash(__('Ordering Question deleted',true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>