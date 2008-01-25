<?php
class BlogsController extends BlogAppController {

	var $name = 'Blogs';
	var $helpers = array('Html', 'Form' );

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
			$this->Session->setFlash('Invalid Blog.');
			$my_blog = $this->Session->read('Auth.Member.Blog.id');
			$this->redirect(array('action'=>'view', $my_blog));
		}
		$this->set('blog',
			$this->Blog->find(
				'first',
				array(
					'conditions' => array('Blog.id' => $id)
				)
			)
		);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Blog->create();
			$this->data['Blog']['member_id'] = $this->Auth->user('id');
			if ($this->Blog->save($this->data)) {
				$this->Session->setFlash('The Blog has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Blog could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Blog');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Blog->save($this->data)) {
				$this->Session->setFlash('The Blog has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Blog could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Blog->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Blog');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Blog->del($id)) {
			$this->Session->setFlash('Blog #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
		
	}
		
		function beforeFilter(){
			parent::beforeFilter();
			$my_id = $this->Session->read('Auth.Member.id');
			if(!$this->Session->check('Auth.Member.Blog.id')){
				$myblog = $this->Blog->field(
					'Blog.id',
					array('Blog.member_id' => $my_id)
				);
			$this->Session->write('Auth.Member.Blog.id', $myblog);
			} 
		}
}
?>
