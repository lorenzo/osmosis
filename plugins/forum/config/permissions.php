<?php
class ForumPermissions extends Object {
		
	var $Topics = array(
		'add'	=> 'Professor',
		'edit'	=> 'Assistant',
		'index'	=> 'Public',
		'view'	=> 'Public',
		'delete'	=> 'Professor'
	);
	
	var $Discussions = array(
		'view'	=> 'Public',
		'add' => 'Attendee',
		'edit'	=> 'Attendee'
	);
		
	var $Responses = array(
		'add' => 'Attendee',
		'edit'	=> 'Attendee'
	);
}
?>