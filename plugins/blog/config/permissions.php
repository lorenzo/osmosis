<?php
class BlogPermissions extends Object {
	
	var $Blogs = array(
		'index'	=> 'Member',
		'view'	=> 'Public',
		'add' => 'Member',
		'edit'	=> 'Member',
		'delete' => 'Member'
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