<?php
class ScoFixture extends CakeTestFixture {
    var $name = 'ScormSco';
  	var $table = 'scorm_scos';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'scorm_id' => array('type'=>'integer', 'null' => false),
			'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'manifest' => array('type'=>'string', 'null' => false),
			'organization' => array('type'=>'string', 'null' => false),
			'identifier' => array('type'=>'string', 'null' => false),
			'href' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'title' => array('type'=>'string', 'null' => false),
			'completionThreshold' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 3),
			'parameters' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'isvisible' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'attemptAbsoluteDurationLimit' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 6),
			'dataFromLMS' => array('type'=>'text', 'null' => true, 'default' => NULL),
			'attemptLimit' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 10),
			'scormType' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 6),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			); 
} 
?>
