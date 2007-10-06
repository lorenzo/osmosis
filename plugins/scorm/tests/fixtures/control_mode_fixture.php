<?php
class ControlModeFixture extends CakeTestFixture {
    var $name = 'ControlMode';
  	var $import = array('model'=>'controlMode'); 
    var $records = array(
    	array(
    		'id'							=> 1,
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