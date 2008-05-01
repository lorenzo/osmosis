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
		$discussion = $this->Discussion->getDiscussion($id);
		$this->Discussion->Response->restrict(
			array(
				'Response' => array('Member'),
				'Discussion' => array('id')
			)
		);
		$responses = $this->paginate('Response', array('Discussion.id' => $id));
		$this->set(compact('discussion', 'responses'));
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
				$this->redirect(array('controller' => 'discussions', 'action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Discussion->read(null, $id);
			if ($this->data['Discussion']['status']=='locked') {
				$this->Session->setFlash(__('This discussion is locked, you cannot edit it anymore.', true));
				$this->redirect(array('controller' => 'discussions', 'action'=>'view', $id));
			}
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
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Security->requireAuth('edit');
	}

}
?>