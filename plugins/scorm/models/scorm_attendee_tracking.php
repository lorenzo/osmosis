<?php
class ScormAttendeeTracking extends ScormAppModel {

	var $name = 'ScormAttendeeTracking';
	var $useTable = 'scorm_attendee_trackings';
	var $validate = array(
		'scorm_id' => VALID_NOT_EMPTY,
		'sco_id' => VALID_NOT_EMPTY,
		'student_id' => VALID_NOT_EMPTY,
		'datamodel_element' => VALID_NOT_EMPTY,
		'value' => VALID_NOT_EMPTY,
	);
	
	function beforeSave() {
		$data = $this->data;
		unset($data['value']);
		$track = $this->find($data);
		if (!empty($track)) $this->data['id'] = $track['ScormAttendeeTracking']['id'];
		return true;
	}

}
?>
