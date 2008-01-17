<?php
class ScormAttendeeTrackingsController extends ScormAppController {

	var $name = 'ScormAttendeeTrackings';

	function index() {
		$this->ScormAttendeeTracking->recursive = 0;
		$this->set('scormAttendeeTrackings', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid Scorm Attendee Tracking.');
			$this->redirect(array('action'=>'index'), null, true);
		}
		$this->set('scormAttendeeTracking', $this->ScormAttendeeTracking->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->cleanUpFields();
			$this->ScormAttendeeTracking->create();
			if ($this->ScormAttendeeTracking->save($this->data)) {
				$this->Session->setFlash('The Scorm Attendee Tracking has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Scorm Attendee Tracking could not be saved. Please, try again.');
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Scorm Attendee Tracking');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if (!empty($this->data)) {
			$this->cleanUpFields();
			if ($this->ScormAttendeeTracking->save($this->data)) {
				$this->Session->setFlash('The Scorm Attendee Tracking has been saved');
				$this->redirect(array('action'=>'index'), null, true);
			} else {
				$this->Session->setFlash('The Scorm Attendee Tracking could not be saved. Please, try again.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ScormAttendeeTracking->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash('Invalid id for Scorm Attendee Tracking');
			$this->redirect(array('action'=>'index'), null, true);
		}
		if ($this->ScormAttendeeTracking->del($id)) {
			$this->Session->setFlash('Scorm Attendee Tracking #'.$id.' deleted');
			$this->redirect(array('action'=>'index'), null, true);
		}
	}

	function store_data() {
		$params = $this->passedArgs;
		debug($params);
		debug($this->params);
		
		$member_id = $this->Session->read('Auth.Member.id');
		$data['student_id'] = $member_id;
		$data['sco_id'] = $params['sco'];
		foreach($this->params['form'] as $datamodel_element => $value) {
			$data['datamodel_element'] = $datamodel_element;
			$existant = $this->ScormAttendeeTracking->find($data);
			var_dump($existant);
			
			if ($existant) $data['id'] = $existant['ScormAttendeeTracking']['id'];
			$data['value'] = $value;
			var_dump($data);
			
			$this->ScormAttendeeTracking->create();
			$this->ScormAttendeeTracking->save($data);
		}
		die;
	}

}
?>
