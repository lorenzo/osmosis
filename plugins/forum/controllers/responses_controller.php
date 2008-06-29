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
class ResponsesController extends ForumAppController {

	var $name = 'Responses';
	var $helpers = array('Html', 'Form');

	function _ownerAuthorization() {	
		if ($this->action == 'edit') {
			$check = false;
			if (isset($this->data['Response']['id']))
				$check = $this->data['Response']['id'];
				
			elseif (isset($this->params['named']['response_id']))
				$check = $this->params['named']['response_id'];
			
			if (!$check)
				return false;
				
			if ($this->Response->isOwner($this->Auth->user('id'),$check))
				return true;
			
			
			$member = $this->Response->field('member_id',array('id' => $check));
			$role = $this->Response->Member->role($member,$this->activeCourse);
			return $this->Response->Member->compareRoles($this->currentRole,$role) >= 0;

		}
			
		return parent::_ownerAuthorization();
	}
	
	function _setActiveCourse() {
		if (parent::_setActiveCourse()) return;
		if (isset($this->params['named']['response_id']) || isset($this->params['named']['discussion_id'])) {
			$discussion_id = (isset($this->params['named']['discussion_id'])) ? $this->params['named']['discussion_id'] :  $this->Response->field('discussion_id', array('id' => $this->params['named']['response_id']));
			$topic_id = $this->Response->Discussion->field('topic_id', array('id' => $discussion_id));
			$this->activeCourse = $this->Response->Discussion->Topic->field('course_id', array('id' => $topic_id));
		}
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->_checkLocked();
			$this->Response->create();
			$this->data['Response']['member_id'] = $this->Auth->user('id');
			$this->data['Response']['content'] = $this->HtmlPurifier->purify($this->data['Response']['content']);
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__('Please write a response', true), 'default', array('class' => 'info'));
			}
			$this->redirect(
				array(
					'controller'	=> 'discussions',
					'action'		=>'view',
					'discussion_id' => $this->data['Response']['discussion_id']
				)
			);
		}
		$this->_redirectIf(true);
	}

	function edit() {
		if (!empty($this->data)) {
			$this->_checkLocked();
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(
					array(
						'controller' => 'discussions',
						'action'=>'view',
						'discussion_id' => $this->Response->field('discussion_id')
					)
				);
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again', true), 'default', array('class' => 'error'));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['response_id']));
			$this->Response->recursive = -1;
			$this->data = $this->Response->read(null, $this->params['named']['response_id']);
		}
	}
	
	function _checkLocked() {
		$locked = false;
		if (isset($this->data['Response']['discussion_id'])) { 
			$locked = $this->Response->Discussion->isLocked($this->data['Response']['discussion_id']);
			$redirect = array('controller' => 'discussions', 'action' => 'view', 'discussion_id' => $this->data['Response']['discussion_id']);
		} elseif (isset($this->data['Response']['id'])) {
			$locked = $this->Response->isLocked($this->data['Response']['id']);
			$this->Response->id = $this->data['Response']['id'];
			$redirect = array('controller' => 'topics', 'action' => 'view', 'discussion_id' => $this->Response->field('discussion_id'));
		}
		if ($locked) {
			$this->Session->setFlash(__('The Discussion is locked', true), 'default', array('class' => 'error'));
			$this->redirect($redirect);
		}
	}
}
?>