<?php
class RollupConsiderationFixture extends CakeTestFixture {
    var $name = 'RollupConsideration';
  	var $import = array('model'=>'rollupConsideration'); 
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