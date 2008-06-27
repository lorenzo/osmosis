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
class TopicsController extends ForumAppController {

	var $name = 'Topics';
	var $helpers = array('Html', 'Form');
	
	function _setActiveCourse() {
		if (parent::_setActiveCourse()) return;
		if (isset($this->params['named']['topic_id'])) {
			$topic_id = $this->params['named']['topic_id'];
			$this->activeCourse = $this->Topic->field('course_id', array('id' => $topic_id));
		}
	}

	function index() {
		if (!isset($this->params['named']['course_id'])) {
			$this->Session->setFlash(__('Invalid Topic', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$course_id = $this->params['named']['course_id'];
		$this->set('topics', $this->Topic->find('all', array('course_id' => $course_id)));
	}
	
	function view() {
		if (!isset($this->params['named']['topic_id'])) {
			$this->Session->setFlash(__('Invalid Topic', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('topic', $this->Topic->getListSummary($this->params['named']['topic_id']));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Topic->create();
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('controller' => 'topics', 'action'=> 'index', 'course_id' => $this->data['Topic']['course_id']));
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		} else {
			$this->data['Topic']['course_id'] = $this->activeCourse;
		}
	}

	function edit() {
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(
					array(
						'controller'	=> 'topics',
						'action'		=> 'index',
						'course_id'		=> $this->Topic->field('course_id')
					)
				);
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['topic_id']));
			$this->data = $this->Topic->read(null, $this->params['named']['topic_id']);
			if ($this->data['Topic']['status']=='locked') {
				$this->Session->setFlash(__('This topic is locked, you cannot edit it anymore.', true), 'default', array('class' => 'info'));
				$this->redirect(
					array(
						'controller'	=> 'topics',
						'action'		=> 'index',
						'course_id'		=> $this->Topic->field('course_id')
					)
				);
			}
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Topic', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$course_id = $this->Topic->field('course_id', $id);
		if ($this->Topic->del($id)) {
			$this->Session->setFlash(__('Topic deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('controller' => 'topics', 'action' => 'index', 'course_id' => $course_id));
		}
	}
}
?>