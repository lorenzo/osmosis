<?php
class RoleFixture extends CakeTestFixture {
    var $name = 'Role';
    var $import = array('model'=>'Role');
    var $records = array(
    	array(
    		'id' => 1,
    		'role' => 'Admin',
    	),
    	array(
    		'id' => 2,
    		'role' => 'Attendee',
    	),
    	array(
    		'id' => 3,
    		'role' => 'Guest',
    		'parent_id' => 2
    	)
    );
} 
?>