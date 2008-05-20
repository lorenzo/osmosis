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
		if ($this->_updateChoiceCount()) {
			return;
		}
		if (!empty($this->data)) {
			$this->_cleanupEmpty();
			$this->ChoiceQuestion->create();
			$this->ChoiceQuestion->set($this->data);
			if ($this->ChoiceQuestion->validates() && $this->ChoiceQuestion->saveAll($this->data, array('validate' => false))) {
				$habtm_data = array(
					'choice_question_id' => $this->ChoiceQuestion->getLastInsertID(),
					'quiz_id' => $this->data['Quiz'][0]['id']
				);
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
	
	private function _updateChoiceCount() {
		$totalChoices = 2;
		$added = false;
		if(isset($this->data['UI']['addChoice']) && $this->data['UI']['addChoice'] ) {
			$totalChoices = count($this->data['ChoiceChoice']) + 1;
			unset($this->data['UI']['addChoice']);
			$added = true;
		}
		$this->set('totalChoices',$totalChoices);
		return $added;
	}
	
	private function _cleanupEmpty() {
		$num_correct = 0;
		for ($i=0;$i<count($this->data['ChoiceChoice']);$i++) {
			$choice = $this->data['ChoiceChoice'][$i];
			if ($i>1 && empty($choice['text']) && empty($choice['position']) && !$choice['correct']) {
				unset($this->data['ChoiceChoice'][$i]);
				$this->data['ChoiceChoice'] = array_values($this->data['ChoiceChoice']);
				$i--;
			} else if ($choice['correct']) $num_correct++;
		}
		$this->data['ChoiceQuestion']['num_correct'] = $num_correct;
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
