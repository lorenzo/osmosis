<?php
class ControlModeFixture extends CakeTestFixture {
    var $name = 'ControlMode';
	var $table = 'scorm_control_modes';
  	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'choiceExit' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'choice' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'flow' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'forwardOnly' => array('type'=>'string', 'null' => false, 'default' => 'false', 'length' => 5),
			'useCurrentAttemptObjectiveInfo' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'useCurrentAttemptProgressInfo' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
    var $records = array(
    	array(
    		'id'							=> 1,
    		'sco_id'                        => 1,
    		'choiceExit'					=> 'false',
			'choice'						=> 'true',
			'flow'							=> 'false',
			'forwardOnly'					=> 'false',
			'useCurrentAttemptObjectiveInfo'=> 'true',
			'useCurrentAttemptProgressInfo'	=> 'true'
		),
    );
} 
?>
