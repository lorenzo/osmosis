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
class TextQuestionsController extends QuizAppController {

	var $name = 'TextQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->TextQuestion->recursive = 0;
		$this->set('textQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Text Question.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('textQuestion', $this->TextQuestion->read(null, $id));
	}

	function add($quiz_id=null) {
		if (!empty($this->data)) {
			$this->TextQuestion->create();
			if($quiz_id) {
				$this->data['Quiz']['id'] = $quiz_id;
			}
			if ($this->TextQuestion->save($this->data)) {
				$habtm_data = array(
					'text_question_id' => $this->TextQuestion->getLastInsertID(),
					'quiz_id' => $this->data['Quiz'][0]['id']
				);
				if ($this->TextQuestion->QuizText->save($habtm_data)) {
					$this->Session->setFlash(__('The Text Question has been saved',true));
					$this->redirect(array('controller' => 'quizzes', 'action'=>'edit', $this->data['Quiz'][0]['id']));
				}
			} else {
				$this->Session->setFlash(__('The Text Question could not be saved. Please, try again.',true));
			}
		}
		if (isset($this->params['named']['quiz_id'])) {
			$this->data['Quiz']['id'] = $this->params['named']['quiz_id'];
		}
		$formats = array(
			'plain' => __('No format',true),
			'pre'	=> __('Preserve original format',true),
			'html'	=> __('Enriched text',true)
			);
		$this->set(compact('formats','quiz_id'));
		if(isset($this->params['named']['quiz'])) {
			$this->data['Quiz']['id'] = $this->params['named']['quiz'];
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Text Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->TextQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Text Question has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Text Question could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TextQuestion->read(null, $id);
		}
		$quizzes = $this->TextQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Text Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->TextQuestion->del($id)) {
			$this->Session->setFlash(__('Text Question deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
