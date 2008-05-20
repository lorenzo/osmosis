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
class AssociationQuestionsController extends AppController {

	var $name = 'AssociationQuestions';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->AssociationQuestion->recursive = 0;
		$this->set('associationQuestions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Association Question.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('associationQuestion', $this->AssociationQuestion->read(null, $id));
	}

	function add() {
		$quiz = null;
		if (isset($this->passedArgs['quiz'])) {
			$quiz = $this->passedArgs['quiz'];
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->AssociationQuestion->create();
			/*$this->data['Quiz']['Quiz'] = array(
				$this->data['Quiz']['Quiz']
		   	);*/
			if ($this->AssociationQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Association Question has been saved',true));
				//$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Association Question could not be saved. Please, try again.',true));
			}
		}
		$quizzes = $this->AssociationQuestion->Quiz->generateList();
		$this->set(compact('quizzes', 'quiz'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Association Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->AssociationQuestion->save($this->data)) {
				$this->Session->setFlash(__('The Association Question has been saved',true));
				//$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Association Question could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssociationQuestion->read(null, $id);
		}
		$quizzes = $this->AssociationQuestion->Quiz->generateList();
		$this->set(compact('quizzes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Association Question',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->AssociationQuestion->del($id)) {
			$this->Session->setFlash(__('Association Question #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
