<?php
class BlogPermissions extends Object {
	
	var $Blogs = array(
		'view'	=> 'Public',
	);
		
	var $Posts = array(
		'add'	=> 'Member',
		'edit'	=> 'Member',
		'view'	=> 'Public',
		'delete'	=> 'Member'
	);
		
	var $Comments = array(
		'add' => 'Member',
		'index'	=> 'Public',
		'view'	=> 'Public',
		'delete' => 'Member'
	);
}
?>