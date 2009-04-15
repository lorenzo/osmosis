<?php
class WikiPermissions extends Object {
	
	var $Wikis = array(
		'index'	=> 'Member',
		'view'	=> 'Public',
		'add' => 'Professor',
		'edit'	=> 'Professor',
		'delete' => 'Professor'
	);
		
	var $Entries = array(
		'add'	=> 'Attendee',
		'edit'	=> 'Attendee',
		'index'	=> 'Public',
		'view'	=> 'Public',
		'restore' => 'Attendee',
		'delete'	=> 'Assistant'
	);
		
	var $Revisions = array(
		'history' => 'Public',
		'diff'	=> 'Public',
		'view'	=> 'Public'
	);
}
?>