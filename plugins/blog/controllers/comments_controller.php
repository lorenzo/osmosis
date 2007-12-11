<?php
class CommentsController extends BlogAppController {

	var $name = 'Comments';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Comment.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add($post_id = null) {
		if (!$post_id && empty($this->data)) {		
			$this->Session->setFlash('Invalid Post');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Comment->create();
			$this->data['Comment']['member_id'] = $this->Auth->user('id');
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash('The Comment has been saved');
				$slug = $this->Comment->Post->field('slug',array('id'=>$this->data['Comment']['post_id']));
				$this->redirect(array('controller'=> 'posts','action'=>'view', $slug), null, true);
			} else {
				$this->Session->setFlash('The Comment could not be saved. Please, try again.');
			}
		}
		$posts = $this->Comment->Post->generateList();
		$this->set(compact('posts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Comment');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash('The Comment has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Comment could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comment->read(null, $id);
		}
		$posts = $this->Comment->Post->generateList();
		$this->set(compact('posts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Comment');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Comment->del($id)) {
			$this->Session->setFlash('Comment #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
