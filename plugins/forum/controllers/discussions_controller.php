<?php
class DiscussionsController extends ForumAppController {

	var $name = 'Discussions';
	var $helpers = array('Html', 'Form');

	function _setActiveCourse() {
		if (parent::_setActiveCourse()) return;
		if (isset($this->params['named']['topic_id'])) {
			$topic_id = $this->params['named']['topic_id'];
			$this->activeCourse = $this->Discussion->Topic->field('course_id', array('id' => $topic_id));
		} else if (isset($this->params['named']['discussion_id'])) {
			$discussion_id = $this->params['named']['discussion_id'];
			$topic_id = $this->Discussion->field('topic_id', array('id' => $discussion_id));
			$this->activeCourse = $this->Discussion->Topic->field('course_id', array('id' => $topic_id));
		}
	}

	function index() {
		$this->Discussion->recursive = 2;
		$this->set('discussions', $this->paginate());
	}

	function view() {
		$this->_redirectIf(!isset($this->params['named']['discussion_id']));
		$id = $this->params['named']['discussion_id'];
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
				$this->redirect(array('controller' => 'topics', 'action'=>'view', 'topic_id' => $this->data['Discussion']['topic_id']));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['topic_id']));
			$this->data['Discussion']['topic_id'] = $this->params['named']['topic_id'];
		}
	}

	function edit() {
		if (!empty($this->data)) {
			$this->data['Discussion']['member_id'] = $this->Auth->user('id');
			if ($this->Discussion->save($this->data)) {
				$this->Session->setFlash(__('The Discussion has been saved', true));
				$this->redirect(array('controller' => 'discussions', 'action'=>'view', 'discussion_id' => $this->Discussion->field('id')));
			} else {
				$this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['discussion_id']));
			$id = $this->params['named']['discussion_id'];
			$this->data = $this->Discussion->read(null, $id);
			if ($this->data['Discussion']['status']=='locked') {
				$this->Session->setFlash(__('This discussion is locked, you cannot edit it anymore.', true));
				$this->redirect(array('controller' => 'discussions', 'action'=>'view', $id));
			}
		}
	}
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Security->requireAuth('edit');
	}

}
?>