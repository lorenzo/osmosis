<?php
//loadModel('scorm.Objective');
class ObjectiveFixture extends CakeTestFixture {
    var $name = 'ScormObjective';
  	var $table = 'scorm_objectives';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'sco_id' => array('type'=>'integer', 'null' => false),
			'satisfiedByMeasure' => array('type'=>'string', 'null' => true, 'default' => 'false', 'length' => 5),
			'minNormalizedMeasure' => array('type'=>'string', 'null' => false, 'default' => '1.0', 'length' => 3),
			'objectiveID' => array('type'=>'string', 'null' => false),
			'primary' => array('type'=>'boolean', 'null' => false, 'default' => '0'),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'					=> 1,
    		'sco_id'				=> 1,
    		'objectiveID'			=> 'SADASFA-FSDADSASD',
    		'satisfiedByMeasure'	=> 'true',
    		'minNormalizedMeasure'	=> '0.6',
		),
    );
} 
?>
