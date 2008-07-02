<?php
class EventsController extends AgendaAppController {

	var $name = 'Events';
	var $helpers = array('Html', 'Form','Calendar');

	function index() {
		$options = array();
		if (isset($this->params['named']['month']))
			$options['month'] = $this->params['named']['month'];
		if (isset($this->params['named']['year']))
			$options['year'] = $this->params['named']['year'];
		
		$activeCourse = $this->_getActiveCourse();
		$this->_redirectIf(empty($activeCourse));
		$options['conditions']['course_id'] = $activeCourse; 
		list($data['month'],$data['year'],$events) = $this->Event->thisMonth($options);
		$this->set(compact('data','events'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Event', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		$activeCourse = $this->_getActiveCourse();
		$this->_redirectIf(empty($activeCourse));
		$this->set('event', $this->Event->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Event->create();
			$this->data['Event']['member_id'] = $this->Auth->user('id');
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash(__('The Event has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index','course_id' => $this->data['Event']['course_id']));
			} else {
				$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		$tags = $this->Event->Tag->find('list');
		$this->set('course_id',$this->_getActiveCourse());
		$this->set(compact('tags'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Event', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				$this->Session->setFlash(__('The Event has been saved', true), 'default', array('class' => 'success'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Event could not be saved. Please, try again.', true), 'default', array('class' => 'error'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null, $id);
		}
		$tags = $this->Event->Tag->find('list');
		$this->set('course_id',$this->_getActiveCourse());
		$this->set(compact('tags'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Event', true), 'default', array('class' => 'error'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Event->del($id)) {
			$this->Session->setFlash(__('Event deleted', true), 'default', array('class' => 'success'));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>