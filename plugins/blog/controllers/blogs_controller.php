<?php
class BlogsController extends BlogAppController {

	var $name = 'Blogs';
	var $helpers = array('Html', 'Form' );

	function index() {
		$this->Blog->recursive = 0;
		$this->set('blogs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Blog.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('blog', $this->Blog->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Blog->create();
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
			$this->redirect(array('action'=>'index'), null, true);
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

}
?>
