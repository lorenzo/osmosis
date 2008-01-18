<?php
class ScoPresentationFixture extends CakeTestFixture {
    var $name = 'ScormScoPresentation';
  	var $import = array('model'=>'ScoPresentation'); 
    var $records = array(
    	array(
    		'id'				=> 1,
    		'sco_id'    => 1,
    		'hideKey'	=> 'previous'
		),
    );
} 
?>
