<?php
class ScormAttendeeTrackingsController extends ScormAppController {

	var $name = 'ScormAttendeeTrackings';

	function index() {
		$this->ScormAttendeeTracking->recursive = 0;
		$this->set('scormAttendeeTrackings', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Scorm Attendee Tracking.',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('scormAttendeeTracking', $this->ScormAttendeeTracking->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ScormAttendeeTracking->create();
			if ($this->ScormAttendeeTracking->save($this->data)) {
				$this->Session->setFlash(__('The Scorm Attendee Tracking has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Scorm Attendee Tracking could not be saved. Please, try again.',true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Scorm Attendee Tracking',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ScormAttendeeTracking->save($this->data)) {
				$this->Session->setFlash(__('The Scorm Attendee Tracking has been saved',true));
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash(__('The Scorm Attendee Tracking could not be saved. Please, try again.',true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ScormAttendeeTracking->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Scorm Attendee Tracking',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ScormAttendeeTracking->del($id)) {
			$this->Session->setFlash(__('Scorm Attendee Tracking #'.$id.' deleted',true));
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

	function store_data() {
		$params = $this->passedArgs;
		$member_id = $this->Session->read('Member.id');
		$data['student_id'] = $member_id;
		$data['sco_id'] = $params['sco'];
		foreach($this->params['form'] as $datamodel_element => $value) {
			$data['datamodel_element'] = $datamodel_element;
			$existant = $this->ScormAttendeeTracking->find($data);
			if ($existant) $data['id'] = $existant['ScormAttendeeTracking']['id'];
			else $this->ScormAttendeeTracking->create();
			$data['value'] = $value;
			$this->ScormAttendeeTracking->save($data);
		}
		die('ok');
	}

}
?>
