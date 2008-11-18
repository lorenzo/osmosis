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
class DiscussionsController extends ForumAppController {

	var $name = 'Discussions';
	var $helpers = array('Html', 'Form');
	
	function _ownerAuthorization() {	
		if ($this->action == 'edit') {
			if (isset($this->params['named']['discussion_id'])) {
				if ($this->Discussion->isOwner($this->Auth->user('id'),$this->params['named']['discussion_id']))
					return true;
					
					$member = $this->Discussion->field('member_id',array('id' => $this->params['named']['discussion_id']));
					$role = $this->Discussion->Member->role($member,$this->activeCourse); 
					return $this->Discussion->Member->compareRoles($this->currentRole,$role) >= 0;
				}
				return false;	
			}
								
		return parent::_ownerAuthorization();
	}

	function _setActiveCourse() {
		if (parent::_setActiveCourse()) return;
		if (isset($this->params['named']['topic_id'])) {
			$topic_id = $this->params['named']['topic_id'];
			$this->activeCourse = $this->Discussion->Topic->field('course_id', array('id' => $topic_id));
		} elseif (isset($this->params['named']['discussion_id'])) {
			$discussion_id = $this->params['named']['discussion_id'];
			$topic_id = $this->Discussion->field('topic_id', array('id' => $discussion_id));
			$this->activeCourse = $this->Discussion->Topic->field('course_id', array('id' => $topic_id));
		}
	}

	function view() {
		$this->_redirectIf(!isset($this->params['named']['discussion_id']));
		$id = $this->params['named']['discussion_id'];
		$discussion = $this->Discussion->getDiscussion($id);
		$this->Discussion->Response->contain(
			array(
				'Member',
				'Discussion' => array('id')
			)
		);
		$responses = $this->paginate('Response', array('Discussion.id' => $id));
		$this->set(compact('discussion', 'responses'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->_checkLocked();
			$this->Discussion->create();
			$this->data['Discussion']['member_id'] = $this->Auth->user('id');
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__d('forum','The Discussion has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('controller' => 'topics', 'action'=>'view', 'topic_id' => $this->data['Discussion']['topic_id']));
			} else {
				$this->Session->setFlash(__d('forum','The Discussion could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['topic_id']));
			$this->data['Discussion']['topic_id'] = $this->params['named']['topic_id'];
		}
	}

	function edit() {
		if (!empty($this->data)) {
			$this->_checkLocked();
			$this->data['Discussion']['member_id'] = $this->Auth->user('id');
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__d('forum','The Discussion has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('controller' => 'discussions', 'action'=>'view', 'discussion_id' => $this->Discussion->field('id')));
			} else {
				$this->Session->setFlash(__d('forum','The Discussion could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['discussion_id']));
			$id = $this->params['named']['discussion_id'];
			$this->data = $this->Discussion->read(null, $id);
		}
	}
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Security->requireAuth('edit');
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('forum','Invalid id for Discussion', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$topic_id = $this->Discussion->field('topic_id', $id);
		if ($this->Discussion->del($id)) {
			$this->Session->setFlash(__d('forum','Topic deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('controller' => 'topics', 'action' => 'index', 'topic_id' => $topic_id));
		}
	}
	
	function _checkLocked() {
		$locked = false;
		if (isset($this->data['Discussion']['topic_id'])) { 
			$locked = $this->Discussion->Topic->isLocked($this->data['Discussion']['topic_id']);
			$redirect = array('controller' => 'topics', 'action' => 'view', 'topic_id' => $this->data['Discussion']['topic_id']);
		} elseif (isset($this->data['Discussion']['id'])) {
			$locked = $this->Discussion->isLocked($this->data['Discussion']['id']);
			$redirect = array('controller' => 'discussions', 'action' => 'view', 'discussions_id' => $this->data['Discussion']['id']);
		}
		if ($locked) {
			$this->Session->setFlash(__d('forum','The Topic or Discussion is locked', true), 'default', array('class' => 'error'));
			$this->redirect($redirect);
		}
	}

}
?>
