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
class PostsController extends BlogAppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form' );
	var $components = array('HtmlPurifier');
	
	function _ownerAuthorization() {
		switch ($this->action) {
			case 'view' :
				return true;
			case 'add' :
				if (isset($this->data['Post']['blog_id']))
					return $this->Post->Blog->isOwner($this->Auth->user('id'),$this->data['Post']['blog_id']);
				
				if (isset($this->params['pass'][0]))
					return $this->Post->Blog->isOwner($this->Auth->user('id'),$this->params['pass'][0]);
				break;
			case 'edit' :
			case 'delete' :
				if (isset($this->data['Post']['id']))
					return $this->Post->isOwner($this->Auth->user('id'),$this->data['Post']['id']);
				
				if (isset($this->params['pass'][0]))
					return $this->Post->isOwner($this->Auth->user('id'),$this->params['pass'][0]);
				break;
		}
			
		return false;
	}

	function add($blog_id = null) {
		if (!$blog_id && empty($this->data)) {		
			$this->Session->setFlash(__d('blog','Invalid Blog', true), 'default', array('class' => 'error'));
			$this->redirect(
				array(
					'controller'	=> 'blogs',
					'action'		=> 'view',
					'member_id'		=> $this->Auth->user('id')
				)
			);
		}
		if (!empty($this->data)) {
			$this->Post->create();
			$this->data['Post']['member_id'] = $this->Auth->user('id');
			$this->data['Post']['body'] = $this->HtmlPurifier->purify($this->data['Post']['body']);			
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__d('blog','The Post has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']));
			} else {
			 	$this->Session->setFlash(__d('blog','The Post could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		if(!isset($this->data['Post']['blog_id'])) {
			$this->data['Post']['blog_id'] = $blog_id;
		}
		
		$blogs = $this->Post->Blog->find('list');
		$this->set(compact('blogs'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__d('blog','Invalid Post',true), 'default', array('class' => 'error'));
			//$this->redirect(array('action'=>'index'), null, true);
			$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']));
		}
		if (!empty($this->data)) {
			$this->data['Post']['body'] = $this->HtmlPurifier->purify($this->data['Post']['body']);	
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__d('blog','The Post has been saved',true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']));
			} else {
				$this->Session->setFlash(__d('blog','The Post could not be saved. Please, try again.',true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__d('blog','Invalid id for Post',true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']), null, true);
		}
		$this->Post->contain('Blog(id)');
		$data = $this->Post->read(array('id'), $id);
		$blog_id = $data['Blog']['id'];
		if ($this->Post->del($id)) {
			$this->Session->setFlash(__d('blog','Post deleted',true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'view', 'controller' => 'blogs', $blog_id), null, true);
		}
	}
	
	function view($slug) {
		$this->Post->contain(array('Blog' => array('Member'), 'Comment' => array('Member')));
		$this->set('post', $this->Post->findBySlug($slug));
	} 

}
?>
