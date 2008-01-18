<?php
class RollupConsiderationFixture extends CakeTestFixture {
    var $name = 'ScormRollupConsideration';
  	var $import = array('model'=>'RollupConsideration'); 
    var $records = array(
    	array(
    		'id'						=> 1,
			'requiredForSatisfied'		=> 'always',
			'requiredForNotSatisfied'	=> 'ifAttempted',
			'requiredForComplete'		=> 'ifNotSkipped',
			'requiredForIncomplete'		=> 'ifNotSuspended',
			'measureSatisfactionIfActive'=> 'true',
		),
    );
} 
?>
