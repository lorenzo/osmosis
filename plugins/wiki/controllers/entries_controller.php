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
class EntriesController extends WikiAppController {

	var $name = 'Entries';
	var $helpers = array('Html', 'Form', 'Javascript');
	var $components = array('HtmlPurifier','Diff');
	
	function _setActiveCourse() {
		if (!isset($this->params['named']['course_id']) && isset($this->params['named']['wiki_id'])) {
			$this->activeCourse = $this->Entry->Wiki->field('course_id',array('id' => $this->params['named']['wiki_id']));
		} else
			parent::_setActiveCourse();
	}
	
	function index() {
		$this->Entry->recursive = 0;
		$this->set('entries', $this->paginate(array('wiki_id' => $this->params['named']['wiki_id'])));
	}

	function view($slug = null) {
		if (!$slug) {
			$this->Session->setFlash(__('Invalid Entry.',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$conditions = array('conditions' => array('slug' => $slug));
		if (isset($this->params['named']['wiki_id']))
			$conditions['conditions']['wiki_id'] = $this->params['named']['wiki_id'];
			
		if (isset($this->params['named']['course_id']))
			$conditions['conditions']['course_id'] = $this->params['named']['course_id'];
		
		$entry = $this->Entry->find('first',$conditions);
		$this->pageTitle = $entry['Entry']['title'];
		$this->set('entry', $entry);
	}

	function add() {
		$wiki_id = null;
		if (isset($this->params['named']['wiki_id']))
			$wiki_id = $this->params['named']['wiki_id'];
		elseif (isset($this->params['named']['course_id'])) {
			$wiki_id = $this->Entry->Wiki->field('id',array('Wiki.course_id' =>$this->params['named']['course_id'])
			);
		}

			
		if (!$wiki_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Wiki',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Entry->create();
			$this->data['Entry']['member_id'] = $this->Auth->user('id');
			$this->data['Entry']['content'] = $this->HtmlPurifier->purify($this->data['Entry']['content']);
			if ($data = $this->Entry->save($this->data)) {
				$this->Session->setFlash(__('The Entry has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array(
					'action'=>'view',
					 $data['Entry']['slug'],
					'wiki_id' => $data['Entry']['wiki_id']));
			} else {
				$this->Session->setFlash(__('The Entry could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		
		if(!isset($this->data['Entry']['wiki_id'])) {
			$this->data['Entry']['wiki_id'] = $wiki_id;
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Entry',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->data['Entry']['member_id'] = $this->Auth->user('id');
			$this->data['Entry']['content'] = $this->HtmlPurifier->purify($this->data['Entry']['content']);
			if ($data = $this->Entry->save($this->data)) {
				$this->Entry->read();
				$this->Session->setFlash(__('The Entry has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(
					array(
						'action'=>'view',
						 $this->Entry->data['Entry']['slug'],
						'wiki_id' => $this->Entry->data['Entry']['wiki_id']
					)
				);
			} else {
				$this->Session->setFlash(__('The Entry could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Entry->read(null, $id);
		}
		$this->pageTitle = sprintf(__('Editing Entry %s',true),$this->data['Entry']['title']);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Entry',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Entry->del($id)) {
			$this->Session->setFlash(__('Entry deleted',true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	function restore($entry_id, $revision = null) {
		if($this->Entry->restore($entry_id,$revision)) {
			$this->Session->setFlash(__('Entry revision restored',true), 'default', array('class' => 'success'));
		}else{
			die;
			$this->Session->setFlash(__('An error occured. The entry revision was not restored',true), 'default', array('class' => 'error'));
		}
		$this->Entry->read(null,$entry_id);
		$this->redirect(array(
			'action'=>'view',
			 $this->Entry->data['Entry']['slug'],
			'wiki_id' => $this->Entry->data['Entry']['wiki_id']));
	}

}
?>