<?php
class ResponsesController extends ForumAppController {

	var $name = 'Responses';
	var $helpers = array('Html', 'Form');
	var $components = array('HtmlPurifier');
	
	function index() {
		$this->Response->recursive = 0;
		$this->set('responses', $this->paginate());
	}
	
	function discussion_responses($discussion_id=null) {
		$this->Response->recursive = 0;
		$this->set('responses', $this->paginate(array('conditions' => array('discussion_id' => $discussion_id))));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Response.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('response', $this->Response->read(null, $id));
	}

	function add($discussion_id=null) {
		if (!empty($this->data)) {
			$this->Response->create();
			$this->data['Response']['member_id'] = $this->Auth->user('id');
			$this->data['Response']['content'] = $this->HtmlPurifier->purify($this->data['Response']['content']);
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
				$this->redirect(array('controller' => 'discussions', 'action'=>'view', $this->data['Response']['discussion_id']));
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again.', true));
			}
		} else {
			$this->data['Response']['discussion_id'] = $discussion_id;
		}
		if ($user_id = $this->Auth->user('id')) {
			$this->data['Response']['member_id'] = $user_id;
		}
		$discussions = $this->Response->Discussion->find('list');
		$members = $this->Response->Member->find('list');
		$this->set(compact('discussions', 'members'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Response', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
				// $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Response->read(null, $id);
		}
		$discussions = $this->Response->Discussion->find('list');
		$members = $this->Response->Member->find('list');
		$this->set(compact('discussions','members'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Response', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Response->del($id)) {
			$this->Session->setFlash(__('Response deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Response->recursive = 0;
		$this->set('responses', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Response.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('response', $this->Response->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Response->create();
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again.', true));
			}
		}
		$discussions = $this->Response->Discussion->find('list');
		$members = $this->Response->Member->find('list');
		$this->set(compact('discussions', 'members'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Response', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Response->read(null, $id);
		}
		$discussions = $this->Response->Discussion->find('list');
		$members = $this->Response->Member->find('list');
		$this->set(compact('discussions','members'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Response', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Response->del($id)) {
			$this->Session->setFlash(__('Response deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>