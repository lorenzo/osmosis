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

	function add($blog_id = null) {
		if (!$blog_id && empty($this->data)) {		
			$this->Session->setFlash(__('Invalid Blog',true));
			$this->redirect(array('action'=>'index', 'controller' => 'members', $this->Session->read('Member.id'), 'plugin'=> null));
		}
		if (!empty($this->data)) {
			$this->Post->create();
			$this->data['Post']['body'] = $this->HtmlPurifier->purify($this->data['Post']['body']);			
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved',true));
				$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']));
			} else {
			 	$this->Session->setFlash(__('The Post could not be saved. Please, try again.',true));
			}
		}
		if(!isset($this->data['Post']['blog_id'])) {
			$this->data['Post']['blog_id'] = $blog_id;
		}
		
		$blogs = $this->Post->Blog->find('list');
		$this->set(compact('blogs'));
	}
	
	function add_comment($post_id = null) {
		if (!$post_id && empty($this->data)) {		
			$this->Session->setFlash('Invalid Post');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Post->Comment->create();
			$this->data['Comment']['member_id'] = $this->Auth->user('id');
			if ($this->Post->Comment->save($this->data)) {
				$this->Session->setFlash('The Comment has been saved');
			} else {
				$this->Session->setFlash('The Comment could not be saved. Please, try again.');
			}
			$slug = $this->Post->field('slug',array('id'=>$this->data['Comment']['post_id']));
			$this->redirect(array('controller'=> 'posts','action'=>'view', $slug), null, true);
		}
		$posts = $this->Post->generateList();
		$this->set(compact('posts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post',true));
			//$this->redirect(array('action'=>'index'), null, true);
			$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved',true));
				$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Post',true));
			$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']), null, true);
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash(__('Post #'.$id.' deleted',true));
			$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']), null, true);
		}
	}
	
	function view($slug) {		
		$this->set('post', $this->Post->findBySlug($slug));
	} 

}
?>
