<?php
class ResponsesController extends ForumAppController {

	var $name = 'Responses';
	var $helpers = array('Html', 'Form');
		
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
				$this->redirect(
					array(
						'controller' => 'discussions',
						'action'=>'view',
						$this->Response->field('discussion_id', array('id' => $this->data['Response']['id']))
					)
				);
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->Response->recursive = -1;
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
}
?>