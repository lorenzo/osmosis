<?php
class ScormAttendeeTrackingsController extends ScormAppController {

	var $name = 'ScormAttendeeTrackings';

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
