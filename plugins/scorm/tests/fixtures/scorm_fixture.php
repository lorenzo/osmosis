<?php
class ScormFixture extends CakeTestFixture {
    var $name = 'Scorm';
  	var $import = array('model' => 'Scorm'); 
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
