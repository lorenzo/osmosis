<?php
//loadModel('scorm.Objective');
class ObjectiveFixture extends CakeTestFixture {
    var $name = 'ScormObjective';
  	var $import = array('model' => 'Objective'); 
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
