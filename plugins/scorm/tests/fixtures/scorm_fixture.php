<?php
class ScormFixture extends CakeTestFixture {
    var $name = 'Scorm';
  	var $table = 'scorm_scorms'; 
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'course_id' => array('type'=>'integer', 'null' => false),
			'name' => array('type'=>'string', 'null' => false),
			'file_name' => array('type'=>'string', 'null' => false),
			'description' => array('type'=>'text', 'null' => false),
			'version' => array('type'=>'string', 'null' => false, 'length' => 9),
			'created' => array('type'=>'datetime', 'null' => false),
			'modified' => array('type'=>'datetime', 'null' => false),
			'hash' => array('type'=>'string', 'null' => false, 'length' => 35),
			'path' => array('type'=>'text', 'null' => false),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'		=> 	1,
    		'course_id'	=>	1,
    		'name'	=> 'testScorm',
    		'file_name' => 'ScromTest.zip',
    		'description' => 'A scorm test',
    		'version'	=> '1.3',
    		'created' => '2007-1-1',
    		'modified'	=> '2007-1-1',
    		'hash'		=> 'slsdaslkfwerew498fwlw'
		)
    );
} 
?>
