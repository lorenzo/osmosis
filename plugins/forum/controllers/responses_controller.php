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
			$this->Response->create();
			$this->data['Response']['member_id'] = $this->Auth->user('id');
			$this->data['Response']['content'] = $this->HtmlPurifier->purify($this->data['Response']['content']);
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
			} else {
				$this->Session->setFlash(__('Please write a response', true));
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
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
				$this->redirect(
					array(
						'controller' => 'discussions',
						'action'=>'view',
						'discussion_id' => $this->Response->field('discussion_id')
					)
				);
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again.', true));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['response_id']));
			$this->Response->recursive = -1;
			$this->data = $this->Response->read(null, $this->params['named']['response_id']);
		}
	}

}
?>
