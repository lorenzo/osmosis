
<?php
class MapInfoFixture extends CakeTestFixture {
    var $name = 'ScormMapInfo';
  	var $table = 'scorm_map_infos';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'objective_id' => array('type'=>'integer', 'null' => false),
			'targetObjectiveID' => array('type'=>'string', 'null' => false),
			'readSatisfiedStatus' => array('type'=>'string', 'null' => true, 'default' => 'true', 'length' => 5),
			'readNormalizedMeasure' => array('type'=>'string', 'null' => false, 'default' => 'true', 'length' => 5),
			'writeSatisfiedStatus' => array('type'=>'string', 'null' => true, 'default' => 'false', 'length' => 5),
			'writeNormalizedMeasure' => array('type'=>'string', 'null' => true, 'default' => 'false', 'length' => 5),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
    var $records = array(
    	array(
    		'id'					=> 1,
    		'objective_id'			=> 1,
    		'targetObjectiveID'		=> 'SADASFA-FSDADSASD',
    		'readSatisfiedStatus'	=> 'true',
    		'readNormalizedMeasure'	=> 'false',
    		'writeSatisfiedStatus'	=> 'false',
    		'writeNormalizedMeasure'=> 'true'
		),
    );
} 
?>
