<?php
class ControlModeFixture extends CakeTestFixture {
    var $name = 'ScormControlMode';
  	var $import = array('model'=>'ControlMode'); 
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
