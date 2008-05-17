<?php
class ResponsesController extends ForumAppController {

	var $name = 'Responses';
	var $helpers = array('Html', 'Form');
	
	function _setActiveCourse() {
		if (parent::_setActiveCourse()) return;
		if (isset($this->params['named']['response_id'])) {
			$discussion_id = $this->Response->field('discussion_id', array('id' => $this->params['named']['response_id']));
			$topic_id = $this->Response->Discussion->field('topic_id', array('id' => $discussion_id));
			$this->activeCourse = $this->Response->Discussion->Topic->field('course_id', array('id' => $topic_id));
		}
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->Response->create();
			$this->data['Response']['member_id'] = $this->Auth->user('id');
			$this->data['Response']['content'] = $this->HtmlPurifier->purify($this->data['Response']['content']);
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
			} else {
				$this->Session->setFlash(__('Please write a response', true));
			}
			$this->redirect(
				array(
					'controller'	=> 'discussions',
					'action'		=>'view',
					'discussion_id' => $this->data['Response']['discussion_id']
				)
			);
		}
		$this->_redirectIf(true);
	}

	function edit() {
		if (!empty($this->data)) {
			if ($this->Response->save($this->data)) {
				$this->Session->setFlash(__('The Response has been saved', true));
				$this->redirect(
					array(
						'controller' => 'discussions',
						'action'=>'view',
						'discussion_id' => $this->Response->field('discussion_id')
					)
				);
			} else {
				$this->Session->setFlash(__('The Response could not be saved. Please, try again.', true));
			}
		} else {
			$this->_redirectIf(!isset($this->params['named']['response_id']));
			$this->Response->recursive = -1;
			$this->data = $this->Response->read(null, $this->params['named']['response_id']);
		}
	}

}
?>