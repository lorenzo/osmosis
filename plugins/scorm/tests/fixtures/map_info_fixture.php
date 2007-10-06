<?php
class MapInfoFixture extends CakeTestFixture {
    var $name = 'MapInfo';
  	var $import = array('model' => 'MapInfo'); 
    var $records = array(
    	array(
    		'id'					=> 1,
    		'targetObjectiveID'		=> 'SADASFA-FSDADSASD',
    		'readSatisfiedStatus'	=> 'true',
    		'readNormalizedMeasure'	=> 'false',
    		'writeSatisfiedStatus'	=> 'false',
    		'writeNormalizedMeasure'=> 'true'
		),
    );
} 
?>