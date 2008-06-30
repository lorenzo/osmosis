<?php
class ScormPermissions extends Object {
	
	var $ScormAttendeeTrackings = array(
		'store_data' => 'Attendee'
	);
		
	var $Scorms = array(
		'add'		=> 'Professor',
		'edit'		=> 'Professor',
		'index'		=> 'Attendee',
		'view'		=> 'Attendee',
		'toc'		=> 'Attendee',
		'delete'	=> 'Professor'
	);
		
	var $Scos = array(
		'api'		=> 'Attendee',
		'view'		=> 'Attendee',
		'completed'	=> 'Attendee'
	);
}
?>