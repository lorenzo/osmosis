<?php
class DiscussionsController extends ForumAppController {

	var $name = 'Discussions';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Discussion->recursive = 2;
		$this->set('discussions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Discussion.', true));
			$this->redirect(array('action'=>'index'));
		}
		$discussion = $this->Discussion->find('first', array('conditions' => array('Discussion.id' => $id), 'count_view' => true));
		$this->data['Response']['discussion_id'] = $discussion['Discussion']['id'];
		$this->set(compact('discussion'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Discussion->create();
			$this->data['Discussion']['member_id'] = $this->Auth->user('id');
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__('The Discussion has been saved', true));
				$this->redirect(array('controller' => 'topics', 'action'=>'view', $this->data['Discussion']['topic_id']));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		}
		if (isset($this->params['named']['topic'])) {
			$this->data['Discussion']['topic_id'] = $this->params['named']['topic'];
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Discussion', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->data['Discussion']['member_id'] = $this->Auth->user('id');
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__('The Discussion has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Discussion->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Discussion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Discussion->del($id)) {
			$this->Session->setFlash(__('Discussion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Discussion->recursive = 0;
		$this->set('discussions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Discussion.', true));
			$this->redirect(array('action'=>'index'));
		}
		$discussion = $this->Discussion->read(null, $id);
		debug($discussion);
		$this->set(compact('discussion'));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Discussion->create();
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__('The Discussion has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		}
		$topics = $this->Discussion->Topic->find('list');
		$members = $this->Discussion->Member->find('list');
		$this->set(compact('topics', 'members'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Discussion', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__('The Discussion has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Discussion->read(null, $id);
		}
		$topics = $this->Discussion->Topic->find('list');
		$members = $this->Discussion->Member->find('list');
		$this->set(compact('topics','members'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Discussion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Discussion->del($id)) {
			$this->Session->setFlash(__('Discussion deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>