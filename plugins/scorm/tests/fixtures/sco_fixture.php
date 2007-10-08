<?php
class ScoFixture extends CakeTestFixture {
    var $name = 'Sco';
  	var $import = array('model' => 'Sco'); 
    var $records = array(
    	array(
    		'id'				=> 1,
    		'scorm_id'			=> 1,
    		'manifest'			=> 'ASDGSDS-SDFSADAS',
    		'organization'		=> 'DMCQ',
    		'identifier'		=> 'CDADASA-GSDGDEG-HRETSAS-SDSDSD',
    		'href'				=> 'index.html',
    		'title'				=> 'First sco',
    		'scormType'			=> 'sco'
		),
    );
} 
?>