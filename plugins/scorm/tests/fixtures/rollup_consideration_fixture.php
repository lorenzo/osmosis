<?php
class RollupConsiderationFixture extends CakeTestFixture {
    var $name = 'ScormRollupConsideration';
  	var $table = 'scorm_rollup_considerations';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'requiredForSatisfied' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'requiredForNotSatisfied' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'requiredForComplete' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'requiredForIncomplete' => array('type'=>'string', 'null' => false, 'default' => 'always', 'length' => 15),
			'measureSatisfactionIfActive' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
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
