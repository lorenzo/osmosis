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
			$this->Session->setFlash(__('Invalid Comment.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('comment', $this->Comment->read(null, $id));
	}

	function add($post_id = null) {
		if (!$post_id && empty($this->data)) {		
			$this->Session->setFlash(__('Invalid Post',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Comment->create();
			$this->data['Comment']['member_id'] = $this->Auth->user('id');
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The Comment has been saved',true));
				$slug = $this->Comment->Post->field('slug',array('id'=>$this->data['Comment']['post_id']));
				$this->redirect(array('controller'=> 'posts','action'=>'view', $slug), null, true);
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.',true));
			}
		}
		$posts = $this->Comment->Post->generateList();
		$this->set(compact('posts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comment',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Comment->save($this->data)) {
				$this->Session->setFlash(__('The Comment has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.',true));
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
			$this->Session->setFlash(__('Invalid id for Comment',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Comment->del($id)) {
			$this->Session->setFlash(__('Comment #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

}
?>
