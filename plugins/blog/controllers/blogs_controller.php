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
class BlogsController extends BlogAppController {

	var $name = 'Blogs';
	var $helpers = array('Html', 'Form');

	function index() {
		$myblog = $this->Session->read('Auth.Member.Blog.id');
		if (!$myblog) {
			$this->redirect(array('action' => 'add'));
		} else {
			$this->redirect(array('action' => 'view', $myblog));
		}
	}

	function view($id = null) {
		if (!$id) {
			if (!isset($this->params['named']['member_id'])) {
				$this->Session->setFlash(__('Invalid Blog.',true));
				$this->redirectIf(true);
			} else {
				$id = $this->Blog->userBlog($this->params['named']['member_id'], true);
				$this->redirect(
					array(
						'plugin'		=> 'blog',
						'controller'	=> 'blogs',
						'action'		=> 'view',
						$id
					)
				);
			}
		}
		$this->set('blog', $this->Blog->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Blog->create();
			$this->data['Blog']['member_id'] = $this->Auth->user('id');
			if ($this->Blog->save($this->data)) {
				$this->Session->setFlash(__('The Blog has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Blog could not be saved. Please, try again.',true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Blog',true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Blog->save($this->data)) {
				$this->Session->setFlash(__('The Blog has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Blog could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Blog->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Blog',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Blog->del($id)) {
			$this->Session->setFlash(__('Blog deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		
	}
		
	function beforeFilter(){
		parent::beforeFilter();
		$my_id = $this->Session->read('Auth.Member.id');
		if (!$this->Session->check('Auth.Member.Blog.id')) {
			$myblog = $this->Blog->field(
				'Blog.id',
				array('Blog.member_id' => $my_id)
			);
			if ($myblog!==false)
				$this->Session->write('Auth.Member.Blog.id', $myblog);
		} 
	}
}
?>
