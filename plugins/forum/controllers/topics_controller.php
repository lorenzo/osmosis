<?php
class TopicsController extends ForumAppController {

	var $name = 'Topics';
	var $helpers = array('Html', 'Form');
	
	function _setActiveCourse() {
		if (parent::_setActiveCourse()) return;
		if (isset($this->params['named']['topic_id'])) {
			$topic_id = $this->params['named']['topic_id'];
			$this->activeCourse = $this->Topic->field('course_id', array('id' => $topic_id));
		}
	}

	function index() {
		if (!isset($this->params['named']['course_id'])) {
			$this->Session->setFlash(__('Invalid Topic.', true));
			$this->redirect(array('action'=>'index'));
		}
		$course_id = $this->params['named']['course_id'];
		$this->set('topics', $this->Topic->find('all', array('course_id' => $course_id)));
	}
	
	function view() {
		if (!isset($this->params['named']['topic_id'])) {
			$this->Session->setFlash(__('Invalid Topic.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('topic', $this->Topic->getListSummary($this->params['named']['topic_id']));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Topic->create();
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect(array('controller' => 'topics', 'action'=> 'index', 'course_id' => $this->data['Topic']['course_id']));
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		} else {
			$this->data['Topic']['course_id'] = $this->activeCourse;
		}
	}

	function edit() {
		if (!empty($this->data)) {
			if ($this->Topic->save($this->data)) {
				$this->Session->setFlash(__('The Topic has been saved', true));
				$this->redirect(
					array(
						'controller'	=> 'topics',
						'action'		=> 'index',
						'course_id'		=> $this->Topic->field('course_id')
					)
				);
			} else {
				$this->Session->setFlash(__('The Topic could not be saved. Please, try again.', true));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['topic_id']));
			$this->data = $this->Topic->read(null, $this->params['named']['topic_id']);
			if ($this->data['Topic']['status']=='locked') {
				$this->Session->setFlash(__('This topic is locked, you cannot edit it anymore.', true));
				$this->redirect(
					array(
						'controller'	=> 'topics',
						'action'		=> 'index',
						'course_id'		=> $this->Topic->field('course_id')
					)
				);
			}
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Topic', true));
			$this->redirect(array('action'=>'index'));
		}
		$course_id = $this->Topic->field('course_id', $id);
		if ($this->Topic->del($id)) {
			$this->Session->setFlash(__('Topic deleted', true));
			$this->redirect(array('controller' => 'topics', 'action' => 'index', 'course_id' => $course_id));
		}
	}
}
?>