<?php
class TopicsController extends ForumAppController {

	var $name = 'Topics';
	var $helpers = array('Html', 'Form');

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Topic.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('topic', $this->Topic->getListSummary($id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Topic->create();
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect(array('controller' => 'forums', 'action'=>'view', $this->data['Topic']['forum_id']));
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		}
		if (isset($this->params['named']['forum'])) {
			$this->data['Topic']['forum_id'] = $this->params['named']['forum'];
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Topic', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect(
					array(
						'controller' => 'forums',
						'action'=>'view',
						$this->Topic->field('forum_id')
					)
				);
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Topic->read(null, $id);
			if ($this->data['Topic']['status']=='locked') {
				$this->Session->setFlash(__('This topic is locked, you cannot edit it anymore.', true));
				$this->redirect(array('controller' => 'forums', 'action'=>'view', $this->data['Topic']['forum_id']));
			}
			
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Topic', true));
			$this->redirect(array('action'=>'index'));
		}
		$forum_id = $this->Topic->field('forum_id', $id);
		if ($this->Topic->del($id)) {
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('controller' => 'forums', 'action'=>'view', $forum_id));
		}
	}
}
?>