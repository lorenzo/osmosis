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
class CommentsController extends BlogAppController {

	var $name = 'Comments';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('blog','Invalid Comment',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add($post_id = null) {
		if (!$post_id && empty($this->data)) {		
			$this->Session->setFlash(__d('blog','Invalid Post',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Comment->create();
			$this->data['Comment']['member_id'] = $this->Auth->user('id');
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__d('blog','The Comment has been saved',true), 'default', array('class' => 'success'));
			} else {
				$this->Session->setFlash(__d('blog','The Comment could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
			$slug = $this->Comment->Post->field('slug',array('id'=>$this->data['Comment']['post_id']));
			$this->redirect(array('controller'=> 'posts','action'=>'view', $slug), null, true);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('blog','Invalid id for Comment',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Comment->del($id)) {
			$this->Session->setFlash(__d('blog','Comment deleted',true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>