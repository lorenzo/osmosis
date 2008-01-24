<?php
class PostsController extends BlogAppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form' );
	var $components = array('HtmlPurifier');

	function index($blog_id) {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate(array('blog_id'=>$blog_id)));
		$this->set('blog_id',$blog_id);
	}

	function add($blog_id = null) {
		if (!$blog_id && empty($this->data)) {		
			$this->Session->setFlash('Invalid Blog');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->Post->create();
			$this->data['Post']['body'] = $this->HtmlPurifier->purify($this->data['Post']['body']);
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash('The Post has been saved');
				$this->redirect(array('action'=>'view', 'controller' => 'blogs', $this->data['Post']['blog_id']));
			} else {
			 	$this->Session->setFlash('The Post could not be saved. Please, try again.');
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
        $this->set('post', $this->Post->findBySlug($slug));
    } 

}
?>
