<?php
class PostsController extends BlogAppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	/*function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Post.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('post', $this->Post->read(null, $id));
	}*/

	function add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash('The Post has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Post could not be saved. Please, try again.');
			}
		}
		$blogs = $this->Post->Blog->generateList();
		$this->set(compact('blogs'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Post');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash('The Post has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Post could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$blogs = $this->Post->Blog->generateList();
		$this->set(compact('blogs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Post');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash('Post #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}
	
	function view($slug) {
        $post = $this->Post->findBySlug($slug);
        
        $this->set('post', $post);
    } 

}
?>
